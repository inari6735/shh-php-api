<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Entity\User;
use App\Http\Component\JsonWebToken;
use App\Http\Component\PasswordHasher;
use App\Http\Exception\UserCredentialsException;
use App\Http\Exception\UserNotFoundException;
use App\Repository\UserRepository;

readonly class LoginService
{
    public function __construct(
        private UserRepository $userRepository,
        private PasswordHasher $passwordHasher
    ) {}

    /**
     * @throws UserNotFoundException
     * @throws UserCredentialsException
     */
    public function authenticateUser(string $email, string $password): void {
        $user = $this->getUserIfExists($email);
        $this->checkCredentials($password, $user->getPassword());
        $this->setJwtCookie($user);
    }

    public function setJwtCookie(User $user): void
    {
        $data = [
            'email' => $user->getEmail()
        ];
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

    /**
     * @throws UserNotFoundException
     */
    private function getUserIfExists(string $email): User
    {
        $user = $this->userRepository->getUserByEmail($email);
        if (!$user) {
            throw new UserNotFoundException(['User with given email doesnt exists']);
        }

        return $user;
    }

    /**
     * @throws UserCredentialsException
     */
    private function checkCredentials(string $password, string $hash): void
    {
        if (!$this->passwordHasher->verify($password, $hash)) {
            throw new UserCredentialsException([]);
        }
    }
}