<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Domain\Specification;

use DateTimeInterface;

final class ImportSpecification
{
    public function __construct(
        private readonly DateTimeInterface $lastImportedAt
    ) {
    }

    public function isImportPost(DateTimeInterface $modifiedAt): bool
    {
        return $modifiedAt > $this->lastImportedAt;
    }
}
