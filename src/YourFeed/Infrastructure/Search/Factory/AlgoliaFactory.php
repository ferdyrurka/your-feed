<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Search\Factory;

use Algolia\AlgoliaSearch\SearchClient;

final class AlgoliaFactory
{
    public function create(?string $appId, ?string $apiKey): SearchClient
    {
        return SearchClient::create($appId, $apiKey);
    }
}
