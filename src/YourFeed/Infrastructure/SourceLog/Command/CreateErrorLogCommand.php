<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command;

use Exception;
use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Enum\Level;
use Stringable;

final class CreateErrorLogCommand
{
    public function __construct(
        private readonly Source $source,
        private readonly Exception|Stringable|string $message,
    ) {
    }

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getMessage(): Exception|Stringable|string
    {
        return $this->message;
    }

    public function getLevel(): Level
    {
        return Level::ERROR;
    }
}
