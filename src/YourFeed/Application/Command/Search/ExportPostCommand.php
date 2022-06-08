<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\Command\Search;

class ExportPostCommand
{
    public function __construct(
        private readonly string $postUuid,
    ) {
    }

    public function getPostUuid(): string
    {
        return $this->postUuid;
    }
}
