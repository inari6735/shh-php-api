<?php

declare(strict_types=1);

namespace App\Component;

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
}