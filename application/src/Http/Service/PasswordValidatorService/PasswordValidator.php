<?php

declare(strict_types=1);

namespace App\Http\Service\PasswordValidatorService;

use App\Entity\Interfaces\PasswordRequirementInterface;
use App\Entity\Interfaces\ValidatorInterface;
use App\Http\Exception\PasswordValidationException;

class PasswordValidator implements ValidatorInterface
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
    public function validate(string $validationString): bool
    {
        /**
         * @var array<PasswordRequirementInterface>
         */
        $validators = $this->validators;
        $validationErrors = [];

        foreach($validators as $validator) {
            if (!$validator->validate($validationString)) {
                $validationErrors[] = $validator->getErrorMessage();
            }
        }

        if (!empty($validationErrors)) {
            throw new PasswordValidationException(
                validationErrors: $validationErrors
            );
        }

        return true;
    }
}