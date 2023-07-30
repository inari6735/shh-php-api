<?php

declare(strict_types=1);

namespace App\Config\Controller;

use App\Http\Controller\LoginController;
use App\Http\Controller\RegistrationController;

class Controllers
{
    public static function getControllers(): array
    {
        return [
            LoginController::class,
            RegistrationController::class
        ];
    }
}