<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Component\Checker\EmailAvailabilityChecker;
use App\Http\Component\Checker\TagAvailabilityChecker;
use App\Http\Component\Validator\EmailValidator\EmailValidator;
use App\Http\Component\Validator\PasswordValidator\PasswordValidator;

class RegistrationService
{
    public function __construct(
        public EmailAvailabilityChecker $emailAvailability,
        public TagAvailabilityChecker   $tagAvailability,
        public EmailValidator           $emailValidator,
        public PasswordValidator        $passwordValidator
    ) {}

    public function registerUserWithCredentials(string $email, string $password, string $tag, string $username): void
    {
        $this->checkCredentials(email: $email, tag: $tag);
        $this->validateCredentials(email: $email, password: $password);

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