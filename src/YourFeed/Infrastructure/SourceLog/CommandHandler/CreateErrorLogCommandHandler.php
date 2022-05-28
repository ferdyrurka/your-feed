<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\CommandHandler;

use Exception;
use Ferdyrurka\YourFeed\Infrastructure\Repository\SourceRepository;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Command\CreateErrorLogCommand;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Entity\SourceLog;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Enum\Level;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Repository\SourceLogRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Support only error logs e.g. warning, error, critical
 */
final class CreateErrorLogCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly SourceLogRepository $sourceLogRepository,
        private readonly SourceRepository $sourceRepository,
    ) {
    }

    public function __invoke(CreateErrorLogCommand $command): void
    {
        $message = [];

        if ($command->getMessage() instanceof Exception) {
            $exception = $command->getMessage();

            $message = [
                'file' => $exception->getFile(),
                'trace' => $exception->getTraceAsString(),
            ];
        }

        $message['message'] = (string) $command->getMessage();

        $this->save($message, Level::ERROR, $command->getSourceId());
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
