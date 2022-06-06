<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Symfony\Messenger;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

abstract class ChainHandlerAbstract
{
    public function __construct(protected readonly MessageBusInterface $commandBus)
    {
    }

    public function next(object $message): void
    {
        $this->commandBus->dispatch(
            (new Envelope($message))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
