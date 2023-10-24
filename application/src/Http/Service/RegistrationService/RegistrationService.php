<?php

declare(strict_types=1);

namespace App\Http\Service\RegistrationService;

use App\Http\Service\EmailAvailabilityService\EmailAvailabilityChecker;
use App\Http\Service\EmailValidatorService\EmailValidator;
use App\Http\Service\PasswordValidatorService\PasswordValidator;
use App\Http\Service\TagAvailabilityService\TagAvailabilityChecker;

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