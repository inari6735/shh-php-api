<?php

declare(strict_types=1);

namespace App\Http\Component;

class PasswordHasher
{
    public function hash(string $password): string
    {
        $options = [
            'cost' => 12,
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}