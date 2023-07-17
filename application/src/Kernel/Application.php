<?php

declare(strict_types=1);

namespace App\Kernel;

use App\Kernel\Component\Response;
use DI\Container;
use App\Kernel\Router;
use DI\ContainerBuilder;

class Application
{
    public Container $container;
    public Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->setContainer();
    }

    private function setContainer(): void
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(dirname(__DIR__) . '/Container/config.php');
        $containerBuilder->useAttributes(true);

        $this->container = $containerBuilder->build();
    }

    public function execute(): void
    {
        $routeParams = $this->router->getRequestMatchingRouteParams();

        if (empty($routeParams)) {
            Response::notFound();
        }

        $controller = $this->container->get($routeParams['controller']);
        $function = $routeParams['function'];

        $controller->$function();
    }
}