<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Slugger;

use DateTime;
use Symfony\Component\String\Slugger\AsciiSlugger;

final class Slugger
{
    public static function slug(string $value): string
    {
        $value = strtolower($value);

        $uniqueHash = md5((new DateTime())->format('Y-m-d H:i:s:u'));

        $slugger = new AsciiSlugger();
        return sprintf(
            '%s-%s',
            $slugger->slug($value),
            substr($uniqueHash, 0, 7),
        );
    }
}
