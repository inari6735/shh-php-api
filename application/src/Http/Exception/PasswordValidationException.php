<?php

declare(strict_types=1);

namespace App\Http\Exception;

use Exception;

class PasswordValidationException extends Exception
{
    public function __construct(
        public array $validationErrors
    )
    {
        parent::__construct();
    }
}