<?php

declare(strict_types=1);

namespace App\Http\Service\EmailAvailabilityService;

use App\Entity\Interfaces\CheckerInterface;
use App\Http\Exception\EmailAvailabilityException;
use App\Repository\UserRepository;

class EmailAvailabilityChecker implements CheckerInterface
{
    private string $errorMessage = 'User with a given email already exists';

    public function __construct(
        private readonly UserRepository $userRepository
    )
    {}

    /**
     * @throws EmailAvailabilityException
     */
    public function check(string $propertyString): bool
    {
        $user = $this->userRepository->getUserByEmail($propertyString);

        if ($user) {
            $errors = [$this->errorMessage];

            throw new EmailAvailabilityException(
                errors: $errors
            );
        }

        return true;
    }
}