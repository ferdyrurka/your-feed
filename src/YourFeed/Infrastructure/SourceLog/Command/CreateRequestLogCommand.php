<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command;

use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Enum\Level;
use Stringable;

final class CreateRequestLogCommand
{
    public function __construct(
        private readonly Source $source,
        private readonly Stringable|string $url,
    ) {
    }

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getUrl(): Stringable|string
    {
        return $this->url;
    }

    public function getLevel(): Level
    {
        return Level::REQUEST;
    }
}
