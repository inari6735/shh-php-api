<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Config\Routes\Routes;
use App\Kernel\Application;
use Dotenv\Dotenv;

$app = new Application();
$app->router->registerRoutes();

$dotEnv = Dotenv::createImmutable(dirname(__DIR__));
$dotEnv->load();

$app->execute();