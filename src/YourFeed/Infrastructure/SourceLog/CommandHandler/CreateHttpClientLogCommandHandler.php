<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\CommandHandler;

use Ferdyrurka\YourFeed\Infrastructure\Repository\SourceRepository;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command\CreateRequestLogCommand;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command\CreateResponseLogCommand;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Entity\SourceLog;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Enum\Level;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Repository\SourceLogRepository;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

/**
 * Support only HTTP client logs e.g. response, request
 */
final class CreateHttpClientLogCommandHandler implements MessageSubscriberInterface
{
    public function __construct(
        private readonly SourceLogRepository $sourceLogRepository,
        private readonly SourceRepository $sourceRepository,
    ) {
    }

    public function handleResponse(CreateResponseLogCommand $command): void
    {
        $this->save(
            [
                'content' => $command->getContent(),
                'code' => $command->getStatusCode(),
            ],
            Level::RESPONSE,
            $command->getSourceId(),
        );
    }

    public function handleRequest(CreateRequestLogCommand $command): void
    {
        $this->save(
            [
                'url' => $command->getUrl(),
            ],
            Level::REQUEST,
            $command->getSourceId(),
        );
    }

    public static function getHandledMessages(): iterable
    {
        return [
            CreateRequestLogCommand::class => [
                'method' => 'handleRequest'
            ],
            CreateResponseLogCommand::class => [
                'method' => 'handleResponse'
            ],
        ];
    }

    private function save(array $data, Level $level, int $sourceId): void
    {
        $this->sourceLogRepository->add(
            new SourceLog(
                $data,
                $level,
                $this->sourceRepository->get($sourceId),
            ),
        );
    }
}
