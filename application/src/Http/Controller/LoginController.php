<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Config\Attributes\Route;
use App\Entity\Enum\HTTPMethod;
use App\Http\Component\JsonWebToken;
use App\Http\Component\Request;
use App\Http\Component\Response;
use App\Http\Exception\UserCredentialsException;
use App\Http\Exception\UserNotFoundException;
use App\Http\Service\LoginService;
use DI\Attribute\Inject;

readonly class LoginController
{
    public function __construct(
        private LoginService $loginService,
        private Request $request
    )
    {}

    /**
     * @throws UserNotFoundException
     * @throws UserCredentialsException
     */
    #[Route(path: '/login', method: HTTPMethod::POST)]
    public function login(): string
    {
        $requestBody = $this->request->getBody();

        if (!isset($requestBody['email'], $requestBody['password'])) {
            return Response::fail();
        }
        $this->loginService->authenticateUser($requestBody['email'], $requestBody['password']);

        return Response::respondSuccess();
    }
}