<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\Command\Search;

use Ferdyrurka\YourFeed\Domain\Entity\Post;

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
