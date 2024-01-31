<?php

namespace Prism\Router;

use Closure;
use Psr\Http\Message\ServerRequestInterface;

class Router implements RouterInterface
{
    protected array $routes = [];

    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }


    public function match(ServerRequestInterface $request): Route|false
    {
        $method = $request->getMethod();
        $path   = $request->getUri()->getPath();

        foreach ($this->routes as $route) {
            if ($route->path == $path && $route->method == $method) {
                return $route;
            }
        }
        return false;
    }
}
