<?php

namespace App\Command;

use App\Actions\CreateLog;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the "name" and "description" arguments of AsCommand replace the
// static $defaultName and $defaultDescription properties
#[AsCommand(
    name: 'app:parse-logs',
    description: 'Parse the log file.',
    aliases: ['app:parse-logs'],
    hidden: false
)]
class ParseCommand extends Command
{
    public function __construct(
        public CreateLog  $createLog
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Parse Logs',
            '============',
            '',
        ]);

        $this->createLog->run('logs.txt');
        $output->writeln('<info>done.</info>');


        return Command::SUCCESS;
    }

}
