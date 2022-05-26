<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\Enum;

enum Level: string
{
    case ERROR = 'ERROR';
    case REQUEST = 'REQUEST';
    case RESPONSE = 'RESPONSE';
}
