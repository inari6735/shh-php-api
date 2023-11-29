<?php

namespace App\Http\Component;

use App\Entity\Interfaces\ExceptionErrorsInterface;
use Exception;

class ExceptionHandler
{
    public function handle(Exception $e): void
    {
        $errors = [$e->getMessage()];
        $message = 'Whoops, something went wrong';
        $code = Response::HTTP_BAD_REQUEST;

        if ($e instanceof ExceptionErrorsInterface) {
            $errors = $e->getErrors();
            $message = $e->getMessage();
            $code = $e->getCode();
        }

        echo Response::fail(
            errors: $errors,
            message: $message,
            code: $code
        );
        exit();
    }
}