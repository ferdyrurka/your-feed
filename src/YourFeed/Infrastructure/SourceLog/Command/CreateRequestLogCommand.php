<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command;

use Stringable;

final class CreateRequestLogCommand
{
    public function __construct(
        private readonly int $sourceId,
        private readonly Stringable|string $url,
    ) {
    }

    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    public function getUrl(): Stringable|string
    {
        return $this->url;
    }
}
