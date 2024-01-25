<?php

namespace Framework\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

abstract class AbstractHandler implements RequestHandlerInterface
{
    public abstract function handle(ServerRequestInterface $request): ResponseInterface;
}
