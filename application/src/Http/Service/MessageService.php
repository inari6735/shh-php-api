<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Entity\Chat;
use App\Repository\ChatRepository;
use Ramsey\Uuid\Uuid;
use Redis;

readonly class MessageService
{
    public function __construct(
        private Redis $redis,
        private ChatRepository $chatRepository
    )
    {}

    public function processChat(int $firstUserId, int $secondUserId): string
    {
        $chatId = $this->getChatId($firstUserId, $secondUserId);
        if ($chatId) {
            return $chatId;
        }

        return $this->createChat($firstUserId, $secondUserId);
    }

    private function createChat(int $firstUserId, int $secondUserId): string
    {
        $chatId = Uuid::uuid4()->toString();
        $chat = new Chat();
        $chat
            ->setChatId($chatId)
            ->setFirstUserId($firstUserId)
            ->setSecondUserId($secondUserId);

        $this->chatRepository->save($chat);

        return $chatId;
    }

    private function getChatId(int $firstUserId, int $secondUserId): string | null
    {
        $chat = $this->chatRepository->getChatIdByFirstUserId($firstUserId) ?? $this->chatRepository->getChatIdByFirstUserId($secondUserId);

        return $chat?->getChatId();
    }

    /**
     * @throws \RedisException
     */
    public function persistMsg(array $data, ?string $chatId, int | null $ttl = null): void
    {
        $id = Uuid::uuid4()->toString();

        foreach ($data as $key => $val) {
            $this->redis->hSet($id, $key, $val);
        }

        $this->redis->rPush($chatId, $id);

        if ($ttl) {
            $this->redis->expire($id, $ttl);
        }
    }

    /**
     * @throws \RedisException
     */
    public function getMessages(string $chatId): array
    {
        $messages = [];
        $msg = [
            "from" => "",
            "to" => "",
            "message" => ""
        ];
        $msgKeys = $this->redis->lRange($chatId, 0, -1);

        foreach ($msgKeys as $msgKey) {
            foreach ($msg as $key => $value) {
                $val = $this->redis->hGet($msgKey, $key);
                if ($key === "to" || $key === "from") {
                    $val = (int)$this->redis->hGet($msgKey, $key);
                }
                $msg[$key] = $val;
            }
            $messages[] = $msg;
        }

        return $messages;
    }
}