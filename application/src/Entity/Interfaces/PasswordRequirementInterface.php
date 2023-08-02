<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

interface PasswordRequirementInterface
{
    public function validate(string $password): int | false;

    public function getErrorMessage(): string;
}