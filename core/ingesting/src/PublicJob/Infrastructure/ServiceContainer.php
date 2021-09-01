<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Infrastructure;

use FeedIo\Factory;
use Ingesting\PublicJob\Adapter\Rss\FeedIoRssReader;
use Ingesting\PublicJob\Application\Model\Iso\RssReader;
use Ingesting\PublicJob\Application\Model\JobRepository;
use Ingesting\PublicJob\Application\Model\Service\JobUniqueService;
use Ingesting\PublicJob\Application\PublicJobContextInterface;
use Ingesting\PublicJob\Application\PublicJobModule;
use Ingesting\PublicJob\Application\Usecase\JobRssDataSourceChecker;
use Ingesting\PublicJob\Application\Usecase\ReadJobRssUsecase;

abstract class ServiceContainer
{
    protected ?PublicJobContextInterface $module = null;

    protected ?JobRepository $jobRepository = null;

    protected ?JobUniqueService $jobUniqueService = null;

    protected ?JobRssDataSourceChecker $readJobRssUsecase = null;

    protected ?RssReader $jobRssReader = null;

    public function module(): PublicJobContextInterface
    {
        if ($this->module === null) {
            $this->module = new PublicJobModule(
                $this->readJobRssUsecase()
            );
        }
        return $this->module;
    }

    protected function jobRssReader(): RssReader
    {
        if ($this->jobRssReader === null) {
            $this->jobRssReader = new FeedIoRssReader(Factory::create()->getFeedIo());
        }

        return $this->jobRssReader;
    }

    public function jobUniqueService(): JobUniqueService
    {
        if ($this->jobUniqueService === null) {
            $this->jobUniqueService = new JobUniqueService($this->jobRepository());
        }

        return $this->jobUniqueService;
    }

    protected function jobRepository(): JobRepository
    {
        if ($this->jobRepository === null) {
            throw new \RuntimeException('JobRepository not yet implemented');
        }

        return $this->jobRepository;
    }

    protected function readJobRssUsecase(): JobRssDataSourceChecker
    {
        if ($this->readJobRssUsecase === null) {
            $this->readJobRssUsecase = new ReadJobRssUsecase(
                $this->jobRssReader(),
                $this->jobUniqueService(),
                $this->jobRepository()
            );
        }

        return $this->readJobRssUsecase;
    }
}
