<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\FeedClient;

use DateTimeImmutable;

class Post
{
    public function __construct(
        private readonly string $id,
        private readonly string $title,
        private readonly string $description,
        private readonly DateTimeImmutable $publicationAt,
        private readonly string $url,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPublicationAt(): DateTimeImmutable
    {
        return $this->publicationAt;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
