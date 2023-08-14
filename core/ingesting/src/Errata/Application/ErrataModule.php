<?php declare(strict_types=1);

namespace Ingesting\Errata\Application;

use Ingesting\Errata\Application\Usecase\ErrataRssDataSoureChecker;

final class ErrataModule implements ErrataContextInterface
{
    public function __construct(
        private ErrataRssDataSoureChecker $readErrataRssUsecase
    ) {
    }

    public function readErrataRssDataSource(): void
    {
        $this->readErrataRssDataSource();
    }
}
