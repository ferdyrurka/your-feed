<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Domain\Service\Post;

final class Checksum
{
    public static function generate(string $title, string $description, string $url): string
    {
        return sha1(
            $title . $description . $url
        );
    }
}
