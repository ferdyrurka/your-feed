<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog;

use Exception;
use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Stringable;
use Symfony\Contracts\HttpClient\ResponseInterface;

interface SourceLoggerInterface
{
    public function response(Source $source, ResponseInterface $response): void;

    public function request(Source $source, string|Stringable $url): void;

    public function error(Source $source, string|Stringable|Exception $message): void;
}
