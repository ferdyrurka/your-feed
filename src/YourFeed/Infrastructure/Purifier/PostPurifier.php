<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Purifier;

use HTMLPurifier;

class PostPurifier
{
    public function __construct(
        private readonly HTMLPurifier $postPurifier,
        private readonly HTMLPurifier $postTitlePurifier,
    ) {
    }

    public function pureTitle(string $title): string
    {
        return $this->postTitlePurifier->purify($title);
    }

    public function pureDescription(string $description): string
    {
        return $this->postPurifier->purify($description);
    }
}
