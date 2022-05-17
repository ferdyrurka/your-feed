<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Application\CommandHandler\Post;

use Ferdyrurka\YourFeed\Application\Command\Post\UpdatePostCommand;
use Ferdyrurka\YourFeed\Domain\Exception\InvalidPostException;
use Ferdyrurka\YourFeed\Infrastructure\Repository\PostRepository;
use Ferdyrurka\YourFeed\Infrastructure\Slugger\Slugger;
use Ferdyrurka\YourFeed\Infrastructure\Symfony\Validator\ViolationMessageHelper;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class UpdatePostCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly ValidatorInterface $validator,
    ) {
    }

    public function __invoke(UpdatePostCommand $command): void
    {
        $post = $command->getPost();

        $post->update(
            $command->getTitle(),
            $command->getDescription(),
            $command->getUrl(),
            Slugger::slug($command->getTitle()),
        );

        $violations = $this->validator->validate($post);

        if ($violations->count()) {
            throw new InvalidPostException($post->getExternalId(), ViolationMessageHelper::toArray($violations));
        }

        $this->postRepository->save($post);
    }
}
