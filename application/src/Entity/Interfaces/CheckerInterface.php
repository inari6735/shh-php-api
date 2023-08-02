<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

interface CheckerInterface
{
    public function check(string $propertyString): bool;
}