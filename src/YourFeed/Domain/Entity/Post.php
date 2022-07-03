<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Domain\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ferdyrurka\YourFeed\Domain\Service\Post\Checksum;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity]
#[UniqueEntity(['slug', 'url', 'externalId'])]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 36)]
    #[Assert\NotBlank]
    #[Assert\Uuid]
    private string $uuid;

    #[ORM\Column(type: 'string', length: 512)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 512)]
    private string $title;

    #[ORM\Column(type: 'string', length: 512, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 512)]
    private string $slug;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    #[Assert\Length(max: 2048)]
    private string $description;

    #[ORM\Column(type: 'string', length: 512, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 512)]
    #[Assert\Url]
    private string $url;

    #[ORM\Column(type: 'string', length: 40)]
    private string $checksum;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $externalId;

    #[ORM\ManyToOne(targetEntity: Source::class, inversedBy: 'posts')]
    #[Assert\NotBlank]
    private Source $source;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotBlank]
    private DateTimeImmutable $publicationAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    public function __construct(
        string $externalId,
        string $title,
        string $description,
        string $url,
        string $slug,
        Source $source,
        DateTimeImmutable $publicationDate,
    ) {
        $this->externalId = $externalId;
        $this->title = $title;
        $this->description = $description;
        $this->slug = $slug;
        $this->uuid = Uuid::v4()->toRfc4122();

        $this->url = $url;

        $this->checksum = Checksum::generate($title, $description, $url);

        $this->source = $source;

        $this->publicationAt = $publicationDate;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = clone $this->createdAt;
    }

    public function update(string $title, string $description, string $url, string $slug): void
    {
        $this->title = $title;
        $this->description = $description;
        $this->slug = $slug;

        $this->url = $url;

        $this->checksum = Checksum::generate($title, $description, $url);
        $this->updatedAt = new DateTimeImmutable();
    }

    public function isSearchable(): bool
    {
        return $this->source->isSearchable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPublicationAt(): DateTimeImmutable
    {
        return $this->publicationAt;
    }

    public function getCategory(): Category
    {
        return $this->source->getCategory();
    }
}
