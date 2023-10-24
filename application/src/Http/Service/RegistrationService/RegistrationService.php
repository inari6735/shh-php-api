<?php

declare(strict_types=1);

namespace App\Http\Service\RegistrationService;

use App\Component\Checker\EmailAvailabilityChecker;
use App\Component\Checker\TagAvailabilityChecker;
use App\Component\Validator\EmailValidator\EmailValidator;
use App\Component\Validator\PasswordValidator\PasswordValidator;

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