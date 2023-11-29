<?php

declare(strict_types=1);

namespace App\Kernel;

use App\Http\Component\ExceptionHandler;
use App\Http\Component\Response;
use DI\Container;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;

class Application
{
    public Container $container;
    public Router $router;

    public function __construct()
    {
        Response::setCorsPolicy();
        $this->router = new Router();
        $this->setContainer();
        $this->setExceptionHandler();
    }

    private function setExceptionHandler(): void
    {
        $exceptionHandler = new ExceptionHandler();
        set_exception_handler([$exceptionHandler, 'handle']);
    }

    private function setContainer(): void
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(dirname(__DIR__) . '/Config/Container/config.php');
        $containerBuilder->useAttributes(true);

        $this->container = $containerBuilder->build();
    }

    public function execute(): void
    {
        $routeParams = $this->router->getRequestMatchingRouteParams();

        if (empty($routeParams)) {
            echo Response::failtNotFound();
            exit();
        }

        $controller = $this->container->get($routeParams['controller']);
        $function = $routeParams['function'];

        echo $controller->$function();
        exit();
    }
}