<?php

declare(strict_types=1);

use Application\Handler\HomeHandler;
use Framework\Application;
use Framework\ApplicationFactory;
use Framework\Router\AuraRouterFactory;
use Interop\Container\ContainerInterface;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\ServiceManager\ServiceManager;
use Laminas\ServiceManager\Factory\InvokableFactory;

use Laminas\ServiceManager\Config;

// Load configuration
$config = require 'config.php';

// Build the container
$container = new ServiceManager();
$container->configure([
    'factories' => [
        Application::class => ApplicationFactory::class,
        \Framework\Router\RouterInterface::class => AuraRouterFactory::class,
        \Application\Handler\HomeHandler::class => \Application\Handler\HomeHandlerFactory::class
    ],
    'invokables' => [
        EmitterInterface::class => SapiEmitter::class,

    ],
]);

//(new Config($config['dependencies']))->configureServiceManager($container);

// Inject config
$container->setService('config', $config);

return $container;