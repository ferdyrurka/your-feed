<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Search;

use Algolia\AlgoliaSearch\SearchClient;
use Algolia\AlgoliaSearch\SearchIndex;
use Symfony\Component\Serializer\SerializerInterface;

class AlgoliaClient implements SearchClientInterface
{
    private SearchIndex $searchIndex;

    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly SearchClient $client,
        string $indexName
    ) {
        $this->searchIndex = $this->client->initIndex($indexName);
    }

    public function save(array|object $data): void
    {
        if (is_object($data)) {
            //todo: support annotations without serializer
            $data = $this->serializer->serialize($data, 'array');
        }

        $this->searchIndex->saveObject(
            $data,
            ['autoGenerateObjectIDIfNotExist' => true],
        );
    }
}
