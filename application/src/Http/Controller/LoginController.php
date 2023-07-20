<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Attributes\Route;
use App\Component\JsonWebToken;
use App\Entity\Enum\HTTPMethod;

class LoginController
{
    public function __construct()
    {}
    #[Route(path: '/login', method: HTTPMethod::GET)]
    public function login(): void
    {
        JsonWebToken::ALGORITHM;
        $jwt = JsonWebToken::createToken();
        echo $jwt;
    }
}