<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Domain\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Import
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToOne(inversedBy: 'import', targetEntity: Source::class)]
    private Source $source;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $lastImportedAt;

    public function __construct(Source $source)
    {
        $this->source = $source;
        $this->lastImportedAt = new DateTimeImmutable('-1 year');
    }

    public function successImport(): void
    {
        $this->lastImportedAt = new DateTimeImmutable();
    }
}
