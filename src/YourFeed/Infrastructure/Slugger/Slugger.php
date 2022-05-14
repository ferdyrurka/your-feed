<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Slugger;

use Symfony\Component\String\Slugger\AsciiSlugger;

//todo: refactoring to application layer set slug or custom own slugger
final class Slugger
{
    public static function slug(string $value): string
    {
        $value = strtolower($value);

        $slugger = new AsciiSlugger();
        return (string) $slugger->slug($value);
    }
}
