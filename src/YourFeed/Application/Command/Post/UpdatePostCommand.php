<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\Command\Post;

use Ferdyrurka\YourFeed\Domain\Entity\Post;

final class UpdatePostCommand
{
    public function __construct(
        private readonly Post $post,
        private readonly string $title,
        private readonly string $description,
        private readonly string $url,
    ) {
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
