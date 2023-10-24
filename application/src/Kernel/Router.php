<?php

declare(strict_types=1);

namespace App\Kernel;

use App\Config\Attributes\Route;
use App\Config\Controller\Controllers;
use App\Entity\Enum\HTTPMethod;
use App\Http\Component\Request;

class Router
{
    public array $routes = [];

    public function registerRoute(
        string $path,
        HTTPMethod $method,
        string $controller,
        string $function
    ): void
    {
        $this->routes[$method->value][$path] = [
            'controller' => $controller,
            'function' => $function
        ];
    }

    public function getRequestMatchingRouteParams(): array
    {
        $request = new Request();

        $method = $request->getMethod();
        $path = $request->getPath();

        return $this->routes[$method][$path] ?? [];
    }

    public function registerRoutes(): void
    {
        $controllers = Controllers::getControllers();

        foreach ($controllers as $controller) {
            $reflectionController = new \ReflectionClass($controller);
            $methods = $reflectionController->getMethods();

            foreach ($methods as $method) {
                $attributes = $method->getAttributes(Route::class);

                foreach ($attributes as $attribute) {
                    /**
                     * @return Route
                     */
                    $route = $attribute->newInstance();

                    $this->registerRoute(
                        path: $route->path,
                        method: $route->method,
                        controller: $controller,
                        function: $method->getName()
                    );
                }
            }
        }
    }
}