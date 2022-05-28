<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command;

use Symfony\Contracts\HttpClient\ResponseInterface;

final class CreateResponseLogCommand
{
    public function __construct(
        private readonly int $sourceId,
        private readonly string $content,
        private readonly int $statusCode,
    ) {
    }

    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
