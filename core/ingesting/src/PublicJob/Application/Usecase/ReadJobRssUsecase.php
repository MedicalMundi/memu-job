<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Usecase;

use Ingesting\PublicJob\Application\Model\Iso\RssData;
use Ingesting\PublicJob\Application\Model\Iso\RssReader;
use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Model\JobId;
use Ingesting\PublicJob\Application\Model\JobRepository;
use Ingesting\PublicJob\Application\Model\Service\JobUniqueService;

class ReadJobRssUsecase implements JobRssDataSourceChecker
{
    private RssReader $rssReader;

    private JobUniqueService $jobUniqueService;

    private JobRepository $repository;

    public function __construct(rssReader $rssReader, JobUniqueService $jobUniqueService, JobRepository $repository)
    {
        $this->rssReader = $rssReader;

        $this->jobUniqueService = $jobUniqueService;

        $this->repository = $repository;
    }

    public function readJobRssDataSource(): void
    {
        $downloadedItem = $this->rssReader->readRssFeed();

        /** @var RssData $item */
        foreach ($downloadedItem as $item) {

            //Todo ramdomness in domain (unpredictable test/assertion)
            $jobId = JobId::generate();

            if (! $this->jobUniqueService->isUnique($jobId)) {
                // todo add custom exception with message 'xxx with id x already exist/used'
                throw new \RuntimeException('Id exist');
            }

            $jobFeed = JobFeed::create($item->title(), $item->description(), $item->link(), $item->publicationDate(), $jobId);

            $this->repository->save($jobFeed);
        }
    }
}
