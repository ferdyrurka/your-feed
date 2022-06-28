<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Doctrine;

use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Webmozart\Assert\Assert;

class Paginator
{
    public function __construct(
        private DoctrinePaginator $paginator,
        private int $limit,
        private int $page,
    ) {
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getItems(): array
    {
        return $this->paginator->getIterator()->getArrayCopy();
    }

    public function getPages(): array
    {
        $totalPages = $this->paginator->count();
        $totalPages = (int) ceil($totalPages / $this->limit);

        return range(1, $totalPages);
    }

    public function hasNextPage(): bool
    {
        return $this->paginator->count() > $this->limit * $this->page;
    }

    public function getNextPage(): int
    {
        Assert::true($this->hasNextPage());

        return $this->page + 1;
    }

    public function hasPreviousPage(): bool
    {
        return $this->page > 1;
    }

    public function getPreviousPage(): int
    {
        Assert::true($this->hasPreviousPage());

        return $this->page - 1;
    }
}
