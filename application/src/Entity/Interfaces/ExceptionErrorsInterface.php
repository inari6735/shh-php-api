<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

interface ExceptionErrorsInterface
{
    public function getErrors(): array;
}