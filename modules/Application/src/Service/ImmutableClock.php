<?php

declare(strict_types=1);

namespace Application\Service;

use DateTimeImmutable;
use Psr\Clock\ClockInterface;

final class ImmutableClock implements ClockInterface
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
