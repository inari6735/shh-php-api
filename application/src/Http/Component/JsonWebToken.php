<?php

declare(strict_types=1);

namespace App\Http\Component;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JsonWebToken
{
    private const ALGORITHM = 'RS256';

    public static function createToken(
        int $issuedAt,
        int $expireAt,
        array $data = []
    ): string
    {
        $privateKeyFile = dirname(__DIR__, 2) . '/Config/JsonWebToken/private.pem';
        $privateKey = openssl_pkey_get_private(
            file_get_contents($privateKeyFile),
            $_ENV['JWT_KEY_PASS']
        );

        $serverName = $_ENV['SERVER_NAME'];

        $payload = [
            'iat' => $issuedAt,
            'iss' => $serverName,
            'nbf' => $issuedAt,
            'exp' => $expireAt
        ];

        $payload = array_merge($payload, $data);

        $jwt = JWT::encode(
            $payload,
            $privateKey,
            self::ALGORITHM
        );

        return $jwt;
    }

    private static function decodeToken(string $token): array
    {
        $publicKeyFile = dirname(__DIR__, 2) . '/Config/JsonWebToken/public.pem';
        $publicKey = openssl_pkey_get_public(file_get_contents($publicKeyFile));

        $decoded = JWT::decode($token, new Key($publicKey, self::ALGORITHM));

        return (array) $decoded;
    }

    public static function validateToken(string $token): array
    {
        return self::decodeToken($token);
    }
}