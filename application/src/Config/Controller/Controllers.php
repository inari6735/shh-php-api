<?php

declare(strict_types=1);

namespace App\Config\Controller;

use App\Http\Controller\LoginController;

class Controllers
{
    public static function getControllers(): array
    {
        return [
            LoginController::class
        ];
    }
}