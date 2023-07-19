<?php

declare(strict_types=1);

namespace App\Config\Routes;

use App\Http\Controller\HomeController;
use App\Kernel\Router;

class Routes
{
    public function registerRoutes(
        Router $router
    ): Router
    {
        $router->get('/', HomeController::class, 'index');

        return $router;
    }
}