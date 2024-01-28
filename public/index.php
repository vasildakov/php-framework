<?php

use Psr\Container\ContainerInterface;
use Framework\ApplicationInterface;
use Framework\Application;
use Laminas\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(static function (): void {
    /** @var ContainerInterface $container */
    $container = require dirname(__DIR__) . '/config/container.php';

    /** @var ApplicationInterface $application */
    $application = $container->get(Application::class);

    //$request = ServerRequestFactory::fromGlobals();

    $application->run();
})();
