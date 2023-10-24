<?php

declare(strict_types=1);

namespace App\Http\Component\Validator\EmailValidator;

use App\Entity\Interfaces\ValidatorInterface;
use App\Http\Exception\EmailValidationException;

class EmailValidator implements ValidatorInterface
{
    private string $errorMessage = 'Given email address is not correct';

    public function validate(string $validationString): bool
    {
        $result = filter_var($validationString, FILTER_VALIDATE_EMAIL);

        if (!$result) {
            $errors = [$this->errorMessage];

            throw new EmailValidationException(
                errors: $errors
            );
        }

        return true;
    }
}