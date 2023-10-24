<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Entity\User;
use App\Http\Component\Checker\EmailAvailabilityChecker;
use App\Http\Component\Checker\TagAvailabilityChecker;
use App\Http\Component\PasswordHasher;
use App\Http\Component\Validator\EmailValidator\EmailValidator;
use App\Http\Component\Validator\PasswordValidator\PasswordValidator;
use App\Repository\UserRepository;

class RegistrationService
{
    public function __construct(
        public EmailAvailabilityChecker $emailAvailability,
        public TagAvailabilityChecker   $tagAvailability,
        public EmailValidator           $emailValidator,
        public PasswordValidator        $passwordValidator,
        public PasswordHasher           $passwordHasher,
        public UserRepository           $userRepository
    ) {}

    public function registerUserFromCredentials(string $email, string $password, string $tag, string $username): void
    {
        $this->checkCredentials(email: $email, tag: $tag);
        $this->validateCredentials(email: $email, password: $password);

        $hashedPassword = $this->passwordHasher->hash($password);
        $this->createUser(email: $email, hash: $hashedPassword, tag: $tag, username: $username);
    }

    public function createUser(string $email, string $hash, string $tag, string $username): void
    {
        $user = new User();
        $user
            ->setEmail($email)
            ->setPassword($hash)
            ->setTag($tag)
            ->setUsername($username);

        $this->userRepository->save($user);
    }

    public function checkCredentials(string $email, string $tag): void
    {
        $this->emailAvailability->check($email);
        $this->tagAvailability->check($tag);
    }

    public function validateCredentials(string $email, string $password): void
    {
        $this->emailValidator->validate($email);
        $this->passwordValidator->validate($password);
    }
}