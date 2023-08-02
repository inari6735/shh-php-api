<?php

declare(strict_types=1);

namespace App\Http\Service\PasswordValidatorService\PasswordRequirements;

use App\Entity\Interfaces\PasswordRequirementInterface;

class NumberRequirement implements PasswordRequirementInterface
{
    private string $errorMessage = 'Password should include at least one number';

    public function validate(string $password): int|false
    {
        return preg_match('@[0-9]@', $password);
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}