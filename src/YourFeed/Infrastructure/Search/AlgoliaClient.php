<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Search;

use Algolia\AlgoliaSearch\SearchClient;

class AlgoliaClient implements SearchClientInterface
{
    public function __construct(private readonly SearchClient $client)
    {
    }
}
