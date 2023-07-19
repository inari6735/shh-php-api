<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Attributes\Route;
use App\Entity\Enum\HTTPMethod;

class HomeController
{
    public function __construct()
    {}
    #[Route(path: '/', method: HTTPMethod::GET)]
    public function index(): void
    {
        echo 'Zapisano do bazy';
    }
}