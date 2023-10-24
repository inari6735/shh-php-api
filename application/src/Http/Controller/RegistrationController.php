<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Config\Attributes\Route;
use App\Entity\Enum\HTTPMethod;
use App\Http\Component\Request;
use App\Http\Component\Response;
use App\Http\Service\RegistrationService;
use DI\Attribute\Inject;

class RegistrationController
{
    public function __construct(
        public RegistrationService $registrationService
    ) {}

    #[Inject]
    #[Route(path: '/register', method: HTTPMethod::POST)]
    public function register(
        Request $request
    ): void
    {
        $requestData = $request->getBody();

        $this->registrationService->registerUserWithCredentials(
            email: $requestData['email'],
            password: $requestData['password'],
            tag: $requestData['tag'],
            username: $requestData['username']
        );

        Response::respondCreated();
    }
}