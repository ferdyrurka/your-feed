<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Domain\Enum;

enum Period: string
{
    //only for debug, delete after WIP project
    case EVERY_MINUTE = 'everyMinute';

    case EVERY_FIVE_MINUTES = 'everyFiveMinutes';

    case EVERY_FIFTEEN_MINUTES = 'everyFifteenMinutes';

    case HOURLY = 'hourly';

    case DAILY = 'daily';

    case WEEKLY = 'weekly';
}
