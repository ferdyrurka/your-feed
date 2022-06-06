<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\UserInterface\CLI\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class PlaygroundCommand extends Command
{
    protected static $defaultName = 'yf:playground';

    public function __construct(
        private readonly MessageBusInterface $commandBus,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //Your playground code

        return Command::SUCCESS;
    }
}
