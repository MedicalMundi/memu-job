<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application;

use Ingesting\PublicJob\Application\Usecase\JobRssDataSourceChecker;

class PublicJobModule implements PublicJobContextInterface
{
    public function __construct(
        private JobRssDataSourceChecker $readRssJobUsecase
    ) {
    }

    public function readJobRssDataSource(): void
    {
        $this->readRssJobUsecase->readJobRssDataSource();
    }
}
