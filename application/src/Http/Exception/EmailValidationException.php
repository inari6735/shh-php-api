<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Entity\Interfaces\ExceptionErrorsInterface;
use App\Http\Component\Response;
use Exception;

class EmailValidationException extends Exception implements ExceptionErrorsInterface
{
    protected $message = 'Email validation error';
    protected $code = Response::HTTP_OK;

    public function __construct(private readonly array $errors)
    {
        parent::__construct();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}