<?php

declare(strict_types=1);

namespace App\Kernel;

use App\Component\Request;

class Router
{
    public array $routes = [];
    public function get(
        string $path,
        string $controller,
        string $function
    ): void
    {
        $this->routes['GET'][$path] = [
            'controller' => $controller,
            'function' => $function
        ];
    }

    public function post(
        string $path,
        string $controller,
        string $function
    ): void
    {
        $this->routes['POST'][$path] = [
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
}