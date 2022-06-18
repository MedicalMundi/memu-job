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

    protected static $defaultDescription = 'Download rss from Gazzetta Ufficiale';

    private JobRssDataSourceChecker $usecase;

    public function __construct(JobRssDataSourceChecker $usecase)
    {
        $this->usecase = $usecase;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('Questo comando verifica la pubblicazione di nuovi RSS feed.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->success('Inizio Rss download (errata)');
        try {
            $this->usecase->readJobRssDataSource();
        } catch (\Exception $exception) {
            $io->error($exception->getMessage());
            return Command::FAILURE;
        }

        $io->success('Download Rss terminato');

        return Command::SUCCESS;
    }
}
