<?php

namespace App\Http\Service\PasswordValidatorService\PasswordRequirements;

interface PasswordRequirementInterface
{
    public function validate(string $password): int | false;

    public function getErrorMessage(): string;
}