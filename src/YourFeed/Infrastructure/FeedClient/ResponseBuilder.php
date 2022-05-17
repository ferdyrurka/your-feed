<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\FeedClient;

use DateTimeImmutable;
use Laminas\Feed\Reader\Feed\FeedInterface;

class ResponseBuilder
{
    public function build(FeedInterface $feed): Feed
    {
        $response = new Feed(
            DateTimeImmutable::createFromMutable($feed->getDateModified()),
        );

        foreach ($feed as $post) {
            $response->addPost(new Post(
                $post->getId(),
                $post->getTitle(),
                $post->getDescription(),
                DateTimeImmutable::createFromMutable($post->getDateCreated()),
                $post->getLink(),
            ));
        }

        return $response;
    }
}
