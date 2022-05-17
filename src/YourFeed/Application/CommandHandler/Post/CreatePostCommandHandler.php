<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\CommandHandler\Post;

use Ferdyrurka\YourFeed\Application\Command\Post\CreatePostCommand;
use Ferdyrurka\YourFeed\Domain\Entity\Post;
use Ferdyrurka\YourFeed\Domain\Exception\InvalidPostException;
use Ferdyrurka\YourFeed\Infrastructure\Repository\PostRepository;
use Ferdyrurka\YourFeed\Infrastructure\Slugger\Slugger;
use Ferdyrurka\YourFeed\Infrastructure\Symfony\Validator\ViolationMessageHelper;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class CreatePostCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly ValidatorInterface $validator,
    ) {
    }

    public function __invoke(CreatePostCommand $command): void
    {
        $post = new Post(
            $command->getId(),
            $command->getTitle(),
            $command->getDescription(),
            $command->getUrl(),
            Slugger::slug($command->getTitle()),
            $command->getCategory(),
            $command->getPublicationDate(),
        );

        $violations = $this->validator->validate($post);

        if ($violations->count()) {
            throw new InvalidPostException($command->getId(), ViolationMessageHelper::toArray($violations));
        }

        $this->postRepository->save($post);
    }
}
