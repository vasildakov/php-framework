<?php

namespace Framework;

use Framework\Router\RouterInterface;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class ApplicationFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : ApplicationInterface
    {
        // router
        $router = $container->get(RouterInterface::class);

        // emitter
        $emitter = $container->get(EmitterInterface::class);

        return new Application($router, $emitter);
    }
}
