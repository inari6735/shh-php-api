<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Config\Routes\Routes;
use App\Kernel\Application;

$app = new Application();
$routes = new Routes();
$app->router = $routes->registerRoutes($app->router);

$app->execute();