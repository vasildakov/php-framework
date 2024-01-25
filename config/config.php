<?php

use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

$array = [
    'dependencies' => [
        'aliases'   => [
            //TemplateRendererInterface::class => TwigRenderer::class,
            //'Twig_Environment'               => Environment::class,
        ],
        'invokables' => [
            EmitterInterface::class => SapiEmitter::class,
            //RouterContainer::class  => InvokableFactory::class,
        ],
        'factories' => [
            Framework\Application::class => Framework\ApplicationFactory::class,
            //Framework\Router\RouterInterface::class => Framework\Container\LaminasRouterFactory::class,
            //Environment::class   => Framework\Template\Twig\TwigEnvironmentFactory::class,
            //TwigRenderer::class  => Framework\Template\Twig\TwigRendererFactory::class,


            DateTime::class => InvokableFactory::class,
        ],
    ],
];

$config = new ArrayObject($array);

return (array) $config;