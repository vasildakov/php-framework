<?php

namespace Prism\Router;

use Closure;

class Route
{
    public function __construct(
        public readonly string $name,
        public readonly string $path,
        public readonly string $method,
        public readonly string|object $handler,
    ) {
    }
}
