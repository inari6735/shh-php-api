<?php

declare(strict_types=1);

namespace App\Http\Service\PasswordValidatorService;

interface PasswordValidatorInterface
{
    public function validate(string $password): bool;
}