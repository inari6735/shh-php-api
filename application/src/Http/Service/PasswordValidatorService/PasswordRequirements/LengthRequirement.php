<?php

namespace App\Http\Service\PasswordValidatorService\PasswordRequirements;

class LengthRequirement implements PasswordRequirementInterface
{
    private string $errorMessage = 'Password should be at least 8 characters in length';

    public function validate(string $password): int|false
    {
        if (strlen($password) < 8) {
            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}