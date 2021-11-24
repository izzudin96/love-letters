<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EmailQuoteCommand extends Command
{
    protected static $defaultName = 'quote:send';
    protected static $defaultDescription = 'Send email containing quote';

    protected function configure()
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'Recipient\'s email');
        $this->addArgument('toEmail', InputArgument::REQUIRED, 'Recipient\'s name');
        $this->addArgument('quoteType', InputArgument::REQUIRED, 'Quote category');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($input->getArgument('name'));
        $output->writeln($input->getArgument('toEmail'));
        $output->writeln($input->getArgument('quoteType'));

        return Command::SUCCESS;
    }
}