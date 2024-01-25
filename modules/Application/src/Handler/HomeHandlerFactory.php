<?php

declare(strict_types=1);

namespace Application\Handler;

use Psr\Container\ContainerInterface;

final class HomeHandlerFactory
{
    public function __invoke(ContainerInterface $container): HomeHandler
    {
        return new HomeHandler();
    }
}
