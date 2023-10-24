<?php

namespace App\Http\Component\Validator\PasswordValidator\PasswordRequirements;

use App\Entity\Interfaces\PasswordRequirementInterface;

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