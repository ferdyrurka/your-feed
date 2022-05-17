<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\Command\Import;

use DateTimeImmutable;
use Ferdyrurka\YourFeed\Domain\Entity\Source;

class ImportPostCommand
{
    public function __construct(
        private readonly string $id,
        private readonly string $title,
        private readonly string $description,
        private readonly string $url,
        private readonly Source $source,
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

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getPublicationDate(): DateTimeImmutable
    {
        return $this->publicationDate;
    }
}
