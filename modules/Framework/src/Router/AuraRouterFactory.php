<?php

namespace Framework\Router;

use Application\Handler\HomeHandler;
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
        $routerContainer = new RouterContainer();
        $map = $routerContainer->getMap();
        $map->get('home', '/', $container->get(HomeHandler::class));

        /* $map->get('home', '/', function ($request, $response) {
            $response->getBody()->write("Hello!!!");
            return $response;
        }); */

        return new AuraRouter($routerContainer);
    }
}
