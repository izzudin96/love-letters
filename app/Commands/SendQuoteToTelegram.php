<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendQuoteToTelegram extends Command
{
    protected static $defaultName = 'quote:send';
    protected static $defaultDescription = 'Send quote to telegram group';

    protected function configure()
    {
        $this->addArgument('quoteType', InputArgument::REQUIRED, 'Quote category');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($input->getArgument('quoteType'));

        return Command::SUCCESS;
    }
}