<?php

use Psr\Container\ContainerInterface;
use Framework\ApplicationInterface;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(static function (): void {
    /** @var ContainerInterface $container */
    $container = require './config/container.php';

    /** @var ApplicationInterface $application */
    $application = $container->get(\Framework\Application::class);

    $application->run();
})();
