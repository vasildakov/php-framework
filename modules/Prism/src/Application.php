<?php

declare(strict_types=1);

namespace Prism;

use Exception;
use Prism\Router\RouterInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
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

    private function isCallable($handler): bool
    {
        return is_callable($handler);
    }

    private function isMiddleware($handler): bool
    {
        return $handler instanceof MiddlewareInterface;
    }

    private function isRequestHandler($handler): bool
    {
        return $handler instanceof RequestHandlerInterface;
    }

    /**
     * @throws Exception
     */
    private function process(ServerRequestInterface $request): ResponseInterface
    {
        $response = (new ResponseFactory())->createResponse();

        $route = $this->router->match($request);
        if (false === $route) {
            return new JsonResponse(['error' => 'Not found!'], 404);
        }

        if ($this->isCallable($route->handler)) {
            $callable = $route->handler;
            $response =  $callable($request, $response);
        }

        if ($this->isRequestHandler($route->handler)) {
            $response = $route->handler->handle($request);
        }

        return $response->withStatus(200);
    }
}
