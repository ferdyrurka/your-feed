<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\CommandHandler;

use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command\CreateErrorLogCommand;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Support only error logs e.g. warning, error, critical
 */
final class CreateErrorLogCommandHandler implements MessageHandlerInterface
{
    public function __invoke(CreateErrorLogCommand $command): void
    {
        // TODO: Implement __invoke() method.
    }
}
