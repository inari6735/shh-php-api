<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

interface ValidatorInterface
{
    public function validate(string $validationString): bool;
}