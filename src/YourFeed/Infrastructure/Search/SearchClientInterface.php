<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Search;

interface SearchClientInterface
{
    public function save(array|object $data): void;
}
