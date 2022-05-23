<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\CommandHandler\Import;

use Ferdyrurka\YourFeed\Application\Command\Import\ImportPostCommand;
use Ferdyrurka\YourFeed\Application\Command\Post\CreatePostCommand;
use Ferdyrurka\YourFeed\Application\Command\Post\UpdatePostCommand;
use Ferdyrurka\YourFeed\Domain\Entity\Post;
use Ferdyrurka\YourFeed\Domain\Service\Post\Checksum;
use Ferdyrurka\YourFeed\Domain\Specification\ImportPostSpecification;
use Ferdyrurka\YourFeed\Infrastructure\Purifier\PostPurifier;
use Ferdyrurka\YourFeed\Infrastructure\Repository\PostRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class ImportPostCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly MessageBusInterface $commandBus,
        private readonly PostPurifier $postPurifier,
    ) {
    }

    public function __invoke(ImportPostCommand $command): void
    {
        $post = $this->postRepository->findOneByExternalId($command->getId());

        $checksum = Checksum::generate($command->getTitle(), $command->getDescription(), $command->getUrl());

        $specification = new ImportPostSpecification($post);

        if (!$specification->isImport($checksum)) {
            return;
        }

        $title = $this->postPurifier->pureTitle($command->getTitle());
        $description = $this->postPurifier->pureDescription($command->getDescription());

        if ($post instanceof Post) {
            $this->commandBus->dispatch(new UpdatePostCommand(
                $post,
                $title,
                $description,
                $command->getUrl(),
            ));

            return;
        }

        $this->commandBus->dispatch(new CreatePostCommand(
            $command->getId(),
            $title,
            $description,
            $command->getUrl(),
            $command->getSource()->getCategory(),
            $command->getPublicationDate(),
        ));
    }
}
