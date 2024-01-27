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

use Fig\Http\Message\StatusCodeInterface;
use Framework\Handler\AbstractHandler;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Clock\ClockInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PingHandler extends AbstractHandler
{
    public function __construct(
        readonly ClockInterface $clock
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface        $response
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(
            [
                'ack' => $this->clock->now()->getTimestamp()
            ],
            StatusCodeInterface::STATUS_OK
        );
    }
}