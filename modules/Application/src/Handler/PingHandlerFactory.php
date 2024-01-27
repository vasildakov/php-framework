<?php

/*
 * This file is part of the Neutrino package.
 *
 * (c) Vasil Dakov <vasildakov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Application\Handler;

use Application\Service\ImmutableClock;
use Psr\Clock\ClockInterface;
use Psr\Container\ContainerInterface;

final class PingHandlerFactory
{
    public function __invoke(ContainerInterface $container): PingHandler
    {
        return new PingHandler($container->get(ImmutableClock::class));
    }
}