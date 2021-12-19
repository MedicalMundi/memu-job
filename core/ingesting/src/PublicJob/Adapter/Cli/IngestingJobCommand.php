<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Adapter\Cli;

use Ingesting\PublicJob\Application\Usecase\JobRssDataSourceChecker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class IngestingJobCommand extends Command
{
    protected static $defaultName = 'app:ingesting:job';

    //protected static string $defaultDescription = 'Download rss from Gazzetta Ufficiale';

    private JobRssDataSourceChecker $usecase;

    public function __construct(JobRssDataSourceChecker $usecase)
    {
        $this->usecase = $usecase;
        parent::__construct();
    }

    protected function configure(): void
    {
        //$this
            //->setDescription(self::$defaultDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        try {
            $this->usecase->readJobRssDataSource();
            $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
        } catch (\Exception $exception) {
            $io->error($exception->getMessage());
            return 1;
        }

        return 0;
    }
}
