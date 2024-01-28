<?php

use Framework\Router\AuraRouterFactory;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

return [
    'dependencies' => [
        'aliases'   => [],
        'invokables' => [
            EmitterInterface::class => SapiEmitter::class,
        ],
        'factories' => [
            \Framework\Application::class => \Framework\ApplicationFactory::class,
            \Framework\Router\RouterInterface::class => AuraRouterFactory::class,
            \Application\Handler\HomeHandler::class => \Application\Handler\HomeHandlerFactory::class,
            \Application\Handler\PingHandler::class => \Application\Handler\PingHandlerFactory::class,
            \Application\Service\ImmutableClock::class => InvokableFactory::class,
        ],
    ],
    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'method' => 'GET',
            'handler' => \Application\Handler\HomeHandler::class
        ],
        [
            'name' => 'ping',
            'path' => '/ping',
            'method' => 'GET',
            'handler' => \Application\Handler\PingHandler::class
        ],
        [
            'name' => 'users',
            'path' => '/users',
            'method' => 'GET',
            'handler' => function ($request) {
                return new JsonResponse(
                    [
                        'users' => [
                            [1],[2],[3],
                        ]
                    ]
                );
            }
        ]
    ],
];
