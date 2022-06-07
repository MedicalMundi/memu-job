<?php declare(strict_types=1);

namespace Ingesting\Errata\Adapter\Cli;

use Ingesting\Errata\Application\Usecase\ErrataRssDataSoureChecker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class IngestingErrataCommand extends Command
{
    protected static $defaultName = 'app:ingesting:errata';

    protected static $defaultDescription = 'Download rss from Gazzetta Ufficiale only errata';

    private ErrataRssDataSoureChecker  $usecase;

    public function __construct(ErrataRssDataSoureChecker $usecase)
    {
        $this->usecase = $usecase;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('Questo comando verifica la pubblicazione di errata corrige dal feed RSS.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->success('Inizio Rss download (errata)');
        try {
            $this->usecase->readErrataRssDataSource();
        } catch (\Exception $exception) {
            $io->error($exception->getMessage());
            return Command::FAILURE;
        }

        $io->success('Download Rss terminato');

        return Command::SUCCESS;
    }
}
