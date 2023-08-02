<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Component\Response;
use App\Entity\Interfaces\ExceptionErrorsInterface;
use Exception;

class PasswordValidationException extends Exception implements ExceptionErrorsInterface
{
    protected $message = 'Password validation error';
    protected $code = Response::CREATED_CODE;

    public function __construct(
        private readonly array $validationErrors
    )
    {
        parent::__construct();
    }

    public function getErrors(): array
    {
        return $this->validationErrors;
    }
}