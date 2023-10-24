<?php

declare(strict_types=1);

namespace App\Component\Validator\PasswordValidator\PasswordRequirements;

use App\Entity\Interfaces\PasswordRequirementInterface;

class SpecialCharsRequirement implements PasswordRequirementInterface
{
    private string $errorMessage = 'Password should include at least one special character';

    public function validate(string $password): int|false
    {
        return preg_match('@[^\w]@', $password);
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}