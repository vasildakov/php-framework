<?php

namespace Framework\Router;

use Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    public function match(ServerRequestInterface $request): object|false;
}
