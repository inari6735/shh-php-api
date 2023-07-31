<?php

declare(strict_types=1);

namespace App\Http\Service\PasswordValidatorService;

use App\Http\Exception\PasswordValidationException;
use App\Http\Service\PasswordValidatorService\PasswordRequirements\PasswordRequirementInterface;

class PasswordValidator implements PasswordValidatorInterface
{
    public function __construct(
        /**
         * @var array<PasswordRequirementInterface>
         */
        public array $validators = []
    )
    {}

    /**
     * @throws PasswordValidationException
     */
    public function validate(string $password): bool
    {
        /**
         * @var array<PasswordRequirementInterface>
         */
        $validators = $this->validators;
        $validationErrors = [];

        foreach($validators as $validator) {
            if (!$validator->validate($password)) {
                $validationErrors[] = $validator->getErrorMessage();
            }
        }

        if (empty($validationMessages)) {
            throw new PasswordValidationException(
                validationErrors: $validationErrors
            );
        }

        return true;
    }
}