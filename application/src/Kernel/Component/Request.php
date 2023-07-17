<?php

declare(strict_types=1);

namespace App\Kernel\Component;

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
}