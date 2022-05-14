<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Domain\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ferdyrurka\YourFeed\Domain\Service\Post\Checksum;
use Ferdyrurka\YourFeed\Infrastructure\Slugger\Slugger;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 512)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 512)]
    private string $title;

    #[ORM\Column(type: 'string', length: 512)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 512)]
    private string $slug;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    #[Assert\Length(max: 2048)]
    private string $description;

    #[ORM\Column(type: 'string', length: 512)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 512)]
    #[Assert\Url]
    private string $url;

    #[ORM\Column(type: 'string', length: 40)]
    private string $checksum;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $publicationDate;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    public function __construct(string $title, string $description, string $url, DateTimeImmutable $publicationDate)
    {
        $this->title = $title;
        $this->description = $description;
        $this->slug = Slugger::slug($url);

        $this->url = $url;

        $this->checksum = Checksum::generate($title, $description, $url);

        $this->publicationDate = $publicationDate;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = clone $this->createdAt;
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getChecksum(): string
    {
        return $this->checksum;
    }

    public function getPublicationDate(): DateTimeImmutable
    {
        return $this->publicationDate;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
