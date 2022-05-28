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

    #[ORM\Column(type: 'json')]
    private array $log;

    #[ORM\Column(type: 'string', enumType: Level::class)]
    private Level $level;

    #[ORM\ManyToOne(targetEntity: Source::class)]
    private Source $source;

    #[ORM\Column(type: 'integer')]
    private int $createdAt;

    public function __construct(array $log, Level $level, Source $source)
    {
        $this->log = $log;
        $this->level = $level;
        $this->source = $source;
        $this->createdAt = (new DateTimeImmutable())->getTimestamp();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLog(): array
    {
        return $this->log;
    }

    public function getLevel(): Level
    {
        return $this->level;
    }

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return (new DateTimeImmutable())->setTimestamp($this->createdAt);
    }
}
