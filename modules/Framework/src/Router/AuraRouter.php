<?php

declare(strict_types=1);

namespace Framework\Router;

use Aura\Router\Route;
use Aura\Router\RouterContainer;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Adapter for Aura Router
 */
final class AuraRouter implements RouterInterface
{
    public function __construct(private readonly RouterContainer $container)
    {
    }

    public function match(ServerRequestInterface $request): Route|false
    {
        $matcher = $this->container->getMatcher();

        return $matcher->match($request);
    }
}
