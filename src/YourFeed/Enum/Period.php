<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Enum;

enum Period: string
{
    case EVERY_15_MINUTES = 'every_15_minutes';
    case EVERY_HOUR = 'every_hour';
    case EVERY_DAY = 'every_day';
    case EVERY_WEEK = 'every_week';
}
