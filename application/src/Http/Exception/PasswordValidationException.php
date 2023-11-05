<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Entity\Interfaces\ExceptionErrorsInterface;
use App\Http\Component\Response;
use Exception;

class PasswordValidationException extends Exception implements ExceptionErrorsInterface
{
    protected $message = 'Password validation error';
    protected $code = Response::HTTP_OK;

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