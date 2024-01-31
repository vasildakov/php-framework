<?php

namespace Prism\Router;

use Psr\Container\ContainerInterface;

class RouterFactory
{
    public function __invoke(ContainerInterface $container): Router
    {
        $config = $container->get('config');
        if (!$config['routes']) {
            throw new \RuntimeException();
        }
        $router = new Router();

        $routes = $config['routes'];
        foreach ($routes as $route) {
            extract($route);
            if (is_string($handler)) {
                $handler = $container->get($handler);
            }

            $router->addRoute(new Route($name, $path, $method, $handler));
        }

        return $router;
    }
}
