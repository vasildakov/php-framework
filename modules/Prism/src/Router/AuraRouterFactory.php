<?php

declare(strict_types=1);

namespace Prism\Router;

use Aura\Router\Exception\ImmutableProperty;
use Aura\Router\Exception\RouteAlreadyExists;
use Aura\Router\RouterContainer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class AuraRouterFactory
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws ImmutableProperty
     * @throws RouteAlreadyExists
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AuraRouter
    {
        $config = $container->get('config');
        if (!$config['routes']) {
            throw new \RuntimeException();
        }
        $routes = $config['routes'];

        $routerContainer = new RouterContainer();
        $map = $routerContainer->getMap();

        foreach ($routes as $route) {
            extract($route);

            if (is_string($handler)) {
                $handler = $container->get($handler);
            }

            $map->route($name, $path, $handler)->allows($method);
        }

        return new AuraRouter($routerContainer);
    }
}
