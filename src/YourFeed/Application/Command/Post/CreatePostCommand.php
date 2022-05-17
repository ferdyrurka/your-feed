<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\Command\Post;

use DateTimeImmutable;
use Ferdyrurka\YourFeed\Domain\Entity\Category;

class CreatePostCommand
{
    public function __construct(
        private readonly string $id,
        private readonly string $title,
        private readonly string $description,
        private readonly string $url,
        private readonly Category $category,
        private readonly DateTimeImmutable $publicationDate,
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

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getPublicationDate(): DateTimeImmutable
    {
        return $this->publicationDate;
    }
}
