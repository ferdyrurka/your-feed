<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\CommandHandler;

use Ferdyrurka\YourFeed\Application\Command\ImportPostCommand;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ImportPostHandler implements MessageHandlerInterface
{
    public function __invoke(ImportPostCommand $command): void
    {
        // TODO: Implement __invoke() method.
    }
}
