<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Usecase;

interface ErrataRssDataSoureChecker
{
    public function readErrataRssDataSource(): void;
}
