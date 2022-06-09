<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\CommandHandler\Search;

use Ferdyrurka\YourFeed\Application\Command\Search\ExportPostCommand;
use Ferdyrurka\YourFeed\Infrastructure\Repository\PostRepository;
use Ferdyrurka\YourFeed\Infrastructure\Search\SearchClientInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ExportPostCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly SearchClientInterface $postSearchClient,
    ) {
    }

    public function __invoke(ExportPostCommand $command): void
    {
        $post = $this->postRepository->get($command->getPostUuid());

        if (!$post->isSearchable()) {
            return;
        }

        $this->postSearchClient->save([
            'objectID' => $post->getUuid(),
            'title' => $post->getTitle(),
            'description' => $post->getDescription(),
            'url' => $post->getUrl(),
            'publicationAt' => $post->getPublicationAt(),
        ]);
    }
}
