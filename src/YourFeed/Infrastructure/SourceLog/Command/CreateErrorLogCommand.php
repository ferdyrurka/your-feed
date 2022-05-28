<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command;

use Exception;
use Stringable;

final class CreateErrorLogCommand
{
    public function __construct(
        private readonly int $sourceId,
        private readonly Exception|Stringable|string $message,
    ) {
    }

    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    public function getMessage(): Exception|Stringable|string
    {
        return $this->message;
    }
}
