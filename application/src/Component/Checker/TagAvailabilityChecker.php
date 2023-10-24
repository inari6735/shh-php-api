<?php

declare(strict_types=1);

namespace App\Component\Checker;

use App\Entity\Interfaces\CheckerInterface;
use App\Http\Exception\TagAvailabilityException;
use App\Repository\UserRepository;

class TagAvailabilityChecker implements CheckerInterface
{
    private string $errorMessage = 'User with a given tag already exists';

    public function __construct(
        private readonly UserRepository $userRepository
    )
    {}

    /**
     * @throws TagAvailabilityException
     */
    public function check(string $propertyString): bool
    {
        $user = $this->userRepository->getUserByTag($propertyString);

        if ($user) {
            $errors = [$this->errorMessage];

            throw new TagAvailabilityException(
                errors: $errors
            );
        }

        return true;
    }
}