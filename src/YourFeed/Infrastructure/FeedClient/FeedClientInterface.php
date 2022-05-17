<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\FeedClient;

interface FeedClientInterface
{
    public function get(string $url): Feed;
}
