<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog;

use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Stringable;

interface SourceLoggerInterface
{
    public function response(Source $source, string|Stringable $response): void;

    public function request(Source $source, string|Stringable $request): void;

    public function error(Source $source, string|Stringable $message): void;

    public function info(Source $source, string|Stringable $message): void;

    public function debug(Source $source, string|Stringable $message): void;
}
