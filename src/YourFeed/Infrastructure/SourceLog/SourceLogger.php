<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog;

use Exception;
use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command\CreateErrorLogCommand;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command\CreateRequestLogCommand;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command\CreateResponseLogCommand;
use Stringable;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SourceLogger implements SourceLoggerInterface
{
    public function __construct(private readonly MessageBusInterface $commandBus)
    {
    }

    public function response(Source $source, ResponseInterface $response): void
    {
        $this->commandBus->dispatch(new CreateResponseLogCommand(
            $source,
            $response,
        ));
    }

    public function request(Source $source, Stringable|string $url): void
    {
        $this->commandBus->dispatch(new CreateRequestLogCommand(
            $source,
            $url,
        ));
    }

    public function error(Source $source, Exception|Stringable|string $message): void
    {
        $this->commandBus->dispatch(new CreateErrorLogCommand(
            $source,
            $message,
        ));
    }
}
