<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Attributes\Route;
use App\Entity\Enum\HTTPMethod;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationController
{
    public function __construct(
        public EntityManagerInterface $entityManager
    ) {}

    #[Route(path: '/register', method: HTTPMethod::GET)]
    public function register(): void {
    }
}