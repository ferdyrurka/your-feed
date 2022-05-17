<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Domain\Specification;

use Ferdyrurka\YourFeed\Domain\Entity\Post;

final class ImportPostSpecification
{
    public function __construct(private ?Post $post)
    {
    }

    public function isImport(string $checksum): bool
    {
        return !$this->post instanceof Post || $checksum !== $this->post->getChecksum();
    }
}
