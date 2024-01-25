<?php

use Framework\Router\AuraRouterFactory;
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
        ],
    ],
    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'method' => 'GET',
            'handler' => \Application\Handler\HomeHandler::class
        ],
    ],
];
