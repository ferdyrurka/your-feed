<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\FeedClient;

use Laminas\Feed\Reader\Reader;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client implements FeedClientInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly ResponseBuilder $responseBuilder,
    ) {
    }

    public function get(string $url): Feed
    {
        $response = $this->httpClient->request(
            'GET',
            $url
        );

        $feed = Reader::importString($response->getContent());

        return $this->responseBuilder->build($feed);
    }
}
