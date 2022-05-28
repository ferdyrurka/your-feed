<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\CommandHandler\Import\Feed;

use Doctrine\Common\Collections\Collection;
use Ferdyrurka\YourFeed\Application\Command\Import\Feed\ImportFeedCommand;
use Ferdyrurka\YourFeed\Application\Command\Import\ImportPostCommand;
use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Ferdyrurka\YourFeed\Domain\Specification\ImportSpecification;
use Ferdyrurka\YourFeed\Infrastructure\FeedClient\FeedClientInterface;
use Ferdyrurka\YourFeed\Infrastructure\FeedClient\Post;
use Ferdyrurka\YourFeed\Infrastructure\Repository\ImportRepository;
use Ferdyrurka\YourFeed\Infrastructure\Repository\SourceRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class ImportFeedCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly SourceRepository $sourceRepository,
        private readonly FeedClientInterface $feedClient,
        private readonly ImportRepository $importRepository,
        private readonly MessageBusInterface $commandBus,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function __invoke(ImportFeedCommand $command): void
    {
        $source = $this->sourceRepository->get($command->getSourceId());
        $import = $source->getImport();

        $response = $this->feedClient->get($source);

        $specification = new ImportSpecification($import->getLastImportedAt());

        if (!$specification->isImportPost($response->getModifiedAt())) {
            return;
        }

        $this->importPosts($response->getPosts(), $source);

        $import->successImport();
        $this->importRepository->save($import);
    }

    private function importPosts(Collection $posts, Source $source): void
    {
        /** @var Post $post */
        foreach ($posts->toArray() as $post) {
            try {
                $this->commandBus->dispatch(new ImportPostCommand(
                    $post->getId(),
                    $post->getTitle(),
                    $post->getDescription(),
                    $post->getUrl(),
                    $source,
                    $post->getPublicationAt()
                ));
            } catch (HandlerFailedException $exception) {
                $this->logger->error($exception->getPrevious());
            }
        }
    }
}
