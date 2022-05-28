<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\Command\Import\Feed;

final class ImportFeedCommand
{
    public function __construct(private readonly int $sourceId)
    {
    }

    public function getSourceId(): int
    {
        return $this->sourceId;
    }
}
