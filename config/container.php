<?php

declare(strict_types=1);

use Laminas\ServiceManager\ServiceManager;
use Laminas\ServiceManager\Config;

// Load configuration
$config = require 'config.php';

// Build the container
$container = new ServiceManager();
(new Config($config['dependencies']))->configureServiceManager($container);

// Inject config
$container->setService('config', $config);

return $container;
