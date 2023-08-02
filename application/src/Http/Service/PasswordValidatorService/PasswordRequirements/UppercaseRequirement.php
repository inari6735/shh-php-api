<?php

declare(strict_types=1);

namespace App\Http\Service\PasswordValidatorService\PasswordRequirements;

use App\Entity\Interfaces\PasswordRequirementInterface;

class UppercaseRequirement implements PasswordRequirementInterface
{
    private string $errorMessage = 'Password should include at least one uppercase case letter';

    public function validate(string $password): int|false
    {
        return preg_match('@[A-Z]@', $password);
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}