<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Exception\UserNotFoundException;
use App\Repository\UserRepository;

readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    /**
     * @throws UserNotFoundException
     */
    public function getUserInfo(string $identifier): array
    {
        $user = $this->userRepository->getUserByEmail($identifier);
        if (!$user) {
            throw new UserNotFoundException([]);
        }

        $data = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'tag' => $user->getTag(),
            'username' => $user->getUsername()
        ];

        return $data;
    }

    public function getSearchUsers(string $queryString): array
    {
        $users = $this->userRepository->getUsersByQueryString($queryString);

        return $users;
    }
}