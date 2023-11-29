<?php

declare(strict_types=1);

namespace App\Http\Component;

use App\Http\Exception\JWTNotFoundException;

class Request
{
    public function getPath(): string
    {
        return parse_url($_SERVER['REQUEST_URI'])['path'];
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getBody(): array
    {
        $jsonBody = file_get_contents('php://input');

        return json_decode($jsonBody, true) ?? [];
    }

    public function getQueryParam(string $param): ?string
    {
        if (!isset($_GET[$param]) or empty($_GET[$param])) {
            return null;
        }

        return $_GET[$param];
    }

    public function getCookie(string $name): ?string
    {
        if (empty($_COOKIE[$name])){
            return null;
        }

        return $_COOKIE[$name];
    }

    public function getUserIdentifier(): string
    {
        $jwt = $this->getCookie('jwt');

        if (!$jwt) {
            throw new JWTNotFoundException([]);
        }

        $decoded = JsonWebToken::validateToken($jwt);

        return $decoded['email'];
    }
}