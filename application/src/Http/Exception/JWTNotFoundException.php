<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Entity\Interfaces\ExceptionErrorsInterface;
use App\Http\Component\Response;
use Exception;

class JWTNotFoundException extends Exception implements ExceptionErrorsInterface
{
    protected $message = 'JWT not found';
    protected $code = Response::NOT_FOUND_CODE;

    public function __construct(private readonly array $errors)
    {
        parent::__construct();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}