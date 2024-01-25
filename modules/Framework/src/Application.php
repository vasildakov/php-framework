<?php

declare(strict_types=1);

namespace Framework;

use Exception;
use Framework\Router\RouterInterface;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Application implements ApplicationInterface
{
    public function __construct(
        private readonly RouterInterface $router,
        private readonly EmitterInterface $emitter
    ) {
    }

    /**
     * @throws Exception
     */
    public function run(ServerRequestInterface $request = null): void
    {
        $request = $request ?: ServerRequestFactory::fromGlobals();

        $response = $this->process($request);

        $this->emitter->emit($response);
    }

    /**
     * @throws Exception
     */
    private function process(ServerRequestInterface $request): ResponseInterface
    {
        $response = (new ResponseFactory())->createResponse();

        $route = $this->router->match($request);
        if (false === $route) {
            throw new Exception('Invalid callable');
        }

        if ($route->handler instanceof RequestHandlerInterface) {
            $response = $route->handler->handle($request);
        }

        if (is_callable($route->handler)) {
            $callable = $route->handler;
            $response =  $callable($request, $response);
        }

        return $response->withStatus(200);
    }
}