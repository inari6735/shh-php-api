<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Attributes\Route;
use App\Component\Request;
use App\Component\Response;
use App\Entity\Enum\HTTPMethod;
use App\Entity\User;
use App\Http\Exception\PasswordValidationException;
use App\Http\Service\PasswordValidatorService\PasswordValidatorInterface;
use DI\Attribute\Inject;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationController
{
    public function __construct(
        public EntityManagerInterface $entityManager
    ) {}

    #[Inject]
    #[Route(path: '/register', method: HTTPMethod::POST)]
    public function register(
        Request $request,
        PasswordValidatorInterface $passwordValidator,
    ): void
    {
        try {
            $passwordValidator->validate('password');
        }
        catch (PasswordValidationException $e) {
            Response::respondCreated(data: ['errors' => $e->validationErrors]);
        }

        Response::respondCreated();
    }
}