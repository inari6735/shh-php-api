<?php

declare(strict_types=1);

namespace App\Component\Validator\PasswordValidator\PasswordRequirements;

use App\Entity\Interfaces\PasswordRequirementInterface;

class LowercaseRequirement implements PasswordRequirementInterface
{
    private string $errorMessage = 'Password should include at least one lowercase case letter';

    public function validate(string $password): int | false
    {
        return preg_match('@[a-z]@', $password);
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}