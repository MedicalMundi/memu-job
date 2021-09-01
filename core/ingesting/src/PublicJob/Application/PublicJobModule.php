<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application;

use Ingesting\PublicJob\Application\Usecase\JobRssDataSourceChecker;

class PublicJobModule implements PublicJobContextInterface
{
    private JobRssDataSourceChecker $readRssJobUsecase;

    public function __construct(JobRssDataSourceChecker $readRssJobUsecase)
    {
        $this->readRssJobUsecase = $readRssJobUsecase;
    }

    public function readJobRssDataSource(): void
    {
        $this->readRssJobUsecase->readJobRssDataSource();
    }
}
