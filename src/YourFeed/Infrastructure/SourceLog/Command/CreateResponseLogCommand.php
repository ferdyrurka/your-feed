<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command;

use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Enum\Level;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class CreateResponseLogCommand
{
    public function __construct(
        private readonly Source $source,
        private readonly ResponseInterface $response,
    ) {
    }

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getLevel(): Level
    {
        return Level::RESPONSE;
    }
}
