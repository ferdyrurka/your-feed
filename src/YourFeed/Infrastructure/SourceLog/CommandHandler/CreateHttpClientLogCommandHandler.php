<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\CommandHandler;

use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command\CreateRequestLogCommand;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command\CreateResponseLogCommand;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

/**
 * Support only HTTP client logs e.g. response, request
 */
final class CreateHttpClientLogCommandHandler implements MessageSubscriberInterface
{
    public function handleResponse(CreateResponseLogCommand $command): void
    {

    }

    public function handleRequest(CreateRequestLogCommand $command): void
    {

    }

    public static function getHandledMessages(): iterable
    {
        return [
            CreateRequestLogCommand::class => [
                'method' => 'handleRequest'
            ],
            CreateResponseLogCommand::class => [
                'method' => 'handleResponse'
            ],
        ];
    }
}
