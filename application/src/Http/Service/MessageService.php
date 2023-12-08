<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Config\Database\RedisConnector;
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

//    public function persist($msg, $timestamp): void
//    {
//    }

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
}