<?php declare(strict_types=1);

namespace Ingesting\Errata\Application;

use Ingesting\Errata\Application\Usecase\ErrataRssDataSoureChecker;

final class ErrataModule implements ErrataContextInterface
{
    private ErrataRssDataSoureChecker $readErrataRssUsecase;

    public function __construct(ErrataRssDataSoureChecker $readErrataRssUsecase)
    {
        $this->readErrataRssUsecase = $readErrataRssUsecase;
    }

    public function readErrataRssDataSource(): void
    {
        $this->readErrataRssDataSource();
    }
}
