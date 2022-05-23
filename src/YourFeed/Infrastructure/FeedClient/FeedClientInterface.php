<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\FeedClient;

use Ferdyrurka\YourFeed\Domain\Entity\Source;

interface FeedClientInterface
{
    public function get(Source $source): Feed;
}
