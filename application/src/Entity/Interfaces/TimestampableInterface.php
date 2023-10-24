<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

use DateTime;

interface TimestampableInterface
{
    public function setCreatedAt(DateTime $createdAt): self;
    public function getCreatedAt(): DateTime;
    public function setUpdatedAt(DateTime $updatedAt): self;
    public function getUpdatedAt(): DateTime;
}