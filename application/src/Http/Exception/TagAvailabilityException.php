<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Entity\Interfaces\ExceptionErrorsInterface;
use Exception;

class TagAvailabilityException extends Exception implements ExceptionErrorsInterface
{
    protected $message = 'Tag availability error';

    public function __construct(private readonly array $errors)
    {
        parent::__construct();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}