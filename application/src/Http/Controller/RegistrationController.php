<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Attributes\Route;
use App\Component\Request;
use App\Component\Response;
use App\Entity\Enum\HTTPMethod;
use App\Entity\Interfaces\ExceptionErrorsInterface;
use App\Http\Service\EmailAvailabilityService\EmailAvailabilityChecker;
use App\Http\Service\EmailValidatorService\EmailValidator;
use App\Http\Service\PasswordValidatorService\PasswordValidator;
use App\Http\Service\TagAvailabilityService\TagAvailabilityChecker;
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
        Request                  $request,
        EmailAvailabilityChecker $emailAvailability,
        TagAvailabilityChecker   $tagAvailability,
        EmailValidator           $emailValidator,
        PasswordValidator        $passwordValidator
    ): void
    {
        $requestData = $request->getBody();

        $email = $requestData['email'];
        $password = $requestData['password'];
        $tag = $requestData['tag'];
        $username = $requestData['username'];

        $emailAvailability->check($email);
        $tagAvailability->check($tag);

        $emailValidator->validate($email);
        $passwordValidator->validate($password);

        Response::respondCreated();
    }
}