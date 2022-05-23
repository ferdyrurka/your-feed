<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\Enum;

enum Level: string
{
    case ERROR = 'ERROR';
    case INFO = 'INFO';
    case DEBUG = 'DEBUG';
    case REQUEST = 'REQUEST';
    case RESPONSE = 'RESPONSE';
}
