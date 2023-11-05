<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Entity\Interfaces\ExceptionErrorsInterface;
use App\Http\Component\Response;

class UserNotFoundException extends \Exception implements ExceptionErrorsInterface
{
    protected $message = 'User not found error';
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