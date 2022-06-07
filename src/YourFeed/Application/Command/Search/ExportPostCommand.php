<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\Command\Search;

class ExportPostCommand
{
    public function __construct(
        private readonly int $postId,
    ) {
    }

    public function getPostId(): int
    {
        return $this->postId;
    }
}
