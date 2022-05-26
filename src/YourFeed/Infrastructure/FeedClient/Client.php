<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\FeedClient;

use Exception;
use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\SourceLoggerInterface;
use Laminas\Feed\Reader\Reader;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client implements FeedClientInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly ResponseBuilder $responseBuilder,
        private readonly SourceLoggerInterface $sourceLogger,
    ) {
    }

    public function get(Source $source): Feed
    {
        try {
            $this->sourceLogger->request($source, $source->getUrl());

            $response = $this->httpClient->request(
                'GET',
                $source->getUrl()
            );
        } catch (Exception $exception) {
            $this->sourceLogger->error($source, $exception);

            throw $exception;
        }

        $this->sourceLogger->response($source, $response);

        $feed = Reader::importString($response->getContent());

        return $this->responseBuilder->build($feed);
    }
}
