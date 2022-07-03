<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\UserInterface\CLI\Command;

use Ferdyrurka\YourFeed\Application\Command\Search\ExportPostCommand;
use Ferdyrurka\YourFeed\Infrastructure\Repository\SourceRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Webmozart\Assert\Assert;

class ExportSearchPostCommand extends Command
{
    protected static $defaultName = 'yf:export:search:post';

    public function __construct(
        private SourceRepository $sourceRepository,
        private MessageBusInterface $commandBus,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Export posts to search engine')
            ->addArgument('sourceId', InputArgument::REQUIRED, 'Source id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sourceId = (int) $input->getArgument('sourceId');

        Assert::greaterThan($sourceId, 0, 'Give invalid source id');

        $source = $this->sourceRepository->get($sourceId);

        $posts = $source->getPosts();

        $progressBar = new ProgressBar($output, $posts->count());

        foreach ($posts as $post) {
            $this->commandBus->dispatch(
                new ExportPostCommand($post->getUuid())
            );

            $progressBar->advance();
        }

        $progressBar->finish();

        return Command::SUCCESS;
    }
}
