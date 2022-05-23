<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Enum\Level;

#[ORM\Entity]
class SourceLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'text')]
    private string $log;

    #[ORM\Column(type: 'string', enumType: Level::class)]
    private string $level;

    #[ORM\ManyToOne(targetEntity: Source::class)]
    private Source $source;

    #[ORM\Column(type: 'integer')]
    private int $createdAt;

    public function __construct(string $log, string $level, Source $source)
    {
        $this->log = $log;
        $this->level = $level;
        $this->source = $source;
        $this->createdAt = (new DateTimeImmutable())->getTimestamp();
    }
}
