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
use Ferdyrurka\YourFeed\Infrastructure\Symfony\Messenger\ChainHandlerAbstract;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class ImportPostCommandHandler extends ChainHandlerAbstract implements MessageHandlerInterface
{
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly PostPurifier $postPurifier,
        readonly MessageBusInterface $commandBus,
    ) {
        parent::__construct($commandBus);
    }

    public function __invoke(ImportPostCommand $command): void
    {
        $post = $this->postRepository->findOneByExternalId($command->getId());

        $checksum = Checksum::generate($command->getTitle(), $command->getDescription(), $command->getUrl());

        if (!(new ImportPostSpecification($post))->isImport($checksum)) {
            return;
        }

        $this->import($post, $command);
    }

    private function import(?Post $post, ImportPostCommand $command): void
    {
        $title = $this->postPurifier->pureTitle($command->getTitle());
        $description = $this->postPurifier->pureDescription($command->getDescription());

        if ($post instanceof Post) {
            $this->next(new UpdatePostCommand($post, $title, $description, $command->getUrl()));

            return;
        }

        $this->next(new CreatePostCommand(
            $command->getId(),
            $title,
            $description,
            $command->getUrl(),
            $command->getSource()->getCategory(),
            $command->getPublicationDate(),
        ));
    }
}
