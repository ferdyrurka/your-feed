<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\Command\Import\Feed;

use Ferdyrurka\YourFeed\Domain\Entity\Source;

final class ImportFeedCommand
{
    public function __construct(private readonly Source $source)
    {
    }

    public function getSource(): Source
    {
        return $this->source;
    }
}
