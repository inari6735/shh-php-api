<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Config\Attributes\Route;
use App\Entity\Enum\HTTPMethod;
use App\Http\Component\Request;
use App\Http\Component\Response;
use App\Http\Service\RegistrationService;
use DI\Attribute\Inject;

readonly class RegistrationController
{
    public function __construct(
        public RegistrationService $registrationService,
        private Request $request
    ) {}

    #[Route(path: '/register', method: HTTPMethod::POST)]
    public function register(): string
    {
        $requestData = $this->request->getBody();

        $this->registrationService->registerUserFromCredentials(
            email: $requestData['email'],
            password: $requestData['password'],
            tag: $requestData['tag'],
            username: $requestData['username']
        );

        return Response::respondCreated();
    }
}