<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Domain\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ferdyrurka\YourFeed\Domain\Enum\Period;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Source
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 64)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 64)]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 512)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 512)]
    #[Assert\Url]
    private ?string $url;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[Assert\NotBlank]
    private ?Category $category;

    #[ORM\Column(type: 'string', enumType: Period::class)]
    #[Assert\NotBlank]
    private ?Period $period;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = clone $this->createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
        $this->update();
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
        $this->update();
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
        $this->update();
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): void
    {
        $this->period = $period;
        $this->update();
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    private function update(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}
