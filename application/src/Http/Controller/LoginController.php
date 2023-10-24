<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Config\Attributes\Route;
use App\Entity\Enum\HTTPMethod;
use App\Http\Component\JsonWebToken;

class LoginController
{
    public function __construct()
    {}
    #[Route(path: '/login', method: HTTPMethod::GET)]
    public function login(): void
    {
        $data = [];

        $time = new \DateTimeImmutable();
        $issuedAt = $time->getTimestamp();
        $expireAt = $time->modify('+7 days')->getTimestamp();

        $jwt = JsonWebToken::createToken(
            issuedAt: $issuedAt,
            expireAt: $expireAt,
            data: $data
        );

        setcookie(
            name: 'jwt',
            value: $jwt,
            path: '/',
            expires_or_options: $expireAt,
            httponly: true,
            secure: false,
        );
    }
}