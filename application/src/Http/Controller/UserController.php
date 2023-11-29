<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Config\Attributes\Route;
use App\Entity\Enum\HTTPMethod;
use App\Http\Component\Request;
use App\Http\Component\Response;
use App\Http\Exception\JWTNotFoundException;
use App\Http\Exception\UserNotFoundException;
use App\Http\Service\UserService;

readonly class UserController
{
    public function __construct(
        private Request $request,
        private UserService $userService
    ) {}

    /**
     * @throws UserNotFoundException
     * @throws JWTNotFoundException
     */
    #[Route(path: '/user', method: HTTPMethod::GET)]
    public function getUser(): string
    {
        $identifier = $this->request->getUserIdentifier();
        $data = $this->userService->getUserInfo($identifier);

        return Response::respondSuccess(data: $data);
    }

    /**
     * @throws JWTNotFoundException
     */
    #[Route(path: '/user/search', method: HTTPMethod::POST)]
    public function getSearchedUsers(): string
    {
        $identifier = $this->request->getUserIdentifier();
        $queryString = $this->request->getQueryParam('queryString');
        $data = $this->userService->getSearchedUsers($queryString);

        return Response::respondSuccess(data: $data);
    }
}