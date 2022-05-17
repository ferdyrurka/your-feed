<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\FeedClient;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Feed
{
    private Collection $posts;

    public function __construct(
        private readonly DateTimeImmutable $modifiedAt,
    ) {
        $this->posts = new ArrayCollection();
    }

    public function addPost(Post $post): void
    {
        $this->posts->add($post);
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function getModifiedAt(): DateTimeImmutable
    {
        return $this->modifiedAt;
    }
}
