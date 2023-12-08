<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('chats')]
class Chat
{
    #[ORM\Id]
    #[ORM\Column(name: 'chat_id', type: 'string', length: 255, nullable: false)]
    private string $chatId;

    #[ORM\Column(name: 'first_user_id', type: 'integer', nullable: false)]
    private int $firstUserId;

    #[ORM\Column(name: 'second_user_id', type: 'integer', nullable: false)]
    private int $secondUserId;

    public function getFirstUserId(): int
    {
        return $this->firstUserId;
    }

    public function setFirstUserId(int $firstUserId): Chat
    {
        $this->firstUserId = $firstUserId;
        return $this;
    }

    public function getSecondUserId(): int
    {
        return $this->secondUserId;
    }

    public function setSecondUserId(int $secondUserId): Chat
    {
        $this->secondUserId = $secondUserId;
        return $this;
    }

    public function getChatId(): string
    {
        return $this->chatId;
    }

    public function setChatId(string $chatId): Chat
    {
        $this->chatId = $chatId;
        return $this;
    }
}
