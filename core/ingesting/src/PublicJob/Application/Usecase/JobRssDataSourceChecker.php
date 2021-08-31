<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Usecase;

use Ingesting\PublicJob\Application\Model\Iso\ApplicationPort;

interface JobRssDataSourceChecker extends ApplicationPort
{
    public function readJobRssDataSource(): void;
}
