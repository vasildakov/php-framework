<?php

use Psr\Container\ContainerInterface;
use Laminas\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(static function (): void {
    /** @var ContainerInterface $container */
    $container = require dirname(__DIR__) . '/config/container.php';

    /** @var \Prism\ApplicationInterface $application */
    $application = $container->get(\Prism\Application::class);

    $request = ServerRequestFactory::fromGlobals();

    $application->run($request);
})();
