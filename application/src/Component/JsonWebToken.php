<?php

declare(strict_types=1);

namespace App\Component;

use Firebase\JWT\JWT;

class JsonWebToken
{
    const ALGORITHM = 'RS256';

    public static function createToken(
        int $issuedAt,
        int $expireAt,
        array $data = []
    ): string
    {
        $privateKeyFile = dirname(__DIR__) . '/Config/JsonWebToken/private.pem';
        $privateKey = openssl_get_privatekey(
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
}