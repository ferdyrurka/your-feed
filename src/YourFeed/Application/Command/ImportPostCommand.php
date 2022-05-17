<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\Command;

use Ferdyrurka\YourFeed\Domain\Entity\Source;

final class ImportPostCommand
{
    public function __construct(private readonly Source $source)
    {
    }

    public function getSource(): Source
    {
        return $this->source;
    }
}
