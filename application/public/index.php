<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Kernel\Application;
use App\Routes\Routes;

$app = new Application();
$routes = new Routes();
$app->router = $routes->registerRoutes($app->router);

$app->execute();