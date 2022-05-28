<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\UserInterface\CLI\Command;

use Ferdyrurka\YourFeed\Application\Command\Import\Feed\ImportFeedCommand;
use Ferdyrurka\YourFeed\Domain\Enum\Period;
use Ferdyrurka\YourFeed\Infrastructure\Repository\SourceRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ImportCommand extends Command
{
    protected static $defaultName = 'yf:import';

    public function __construct(
        private readonly SourceRepository $sourceRepository,
        private readonly MessageBusInterface $commandBus,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('period', 'p', InputOption::VALUE_REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $period = Period::from($input->getOption('period'));

        foreach ($this->sourceRepository->findByPeriod($period) as $source) {
            $this->commandBus->dispatch(new ImportFeedCommand($source->getId()));
        }

        return Command::SUCCESS;
    }
}
