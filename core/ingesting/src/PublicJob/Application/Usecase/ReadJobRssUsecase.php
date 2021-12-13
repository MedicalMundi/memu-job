<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Usecase;

use Ingesting\PublicJob\Application\Model\Iso\RssData;
use Ingesting\PublicJob\Application\Model\Iso\RssReader;
use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Model\JobFeedAlreadyExist;
use Ingesting\PublicJob\Application\Model\JobId;
use Ingesting\PublicJob\Application\Model\JobRepository;
use Ingesting\PublicJob\Application\Model\Service\JobUniqueService;
use Ingesting\PublicJob\Application\Model\Service\UniqueLink;

class ReadJobRssUsecase implements JobRssDataSourceChecker
{
    private RssReader $rssReader;

    private JobUniqueService $identityChecker;

    private UniqueLink $linkChecker;

    private JobRepository $repository;

    public function __construct(rssReader $rssReader, JobUniqueService $jobUniqueService, UniqueLink $uniqueLink, JobRepository $repository)
    {
        $this->rssReader = $rssReader;

        $this->identityChecker = $jobUniqueService;

        $this->linkChecker = $uniqueLink;

        $this->repository = $repository;
    }

    public function readJobRssDataSource(): void
    {
        $downloadedItem = $this->rssReader->readRssFeed();

        /** @var RssData $item */
        foreach ($downloadedItem as $item) {
            if (! $this->linkChecker->isUniqueLink($item->link())) {
                return;
            }

            $jobId = JobId::generate();

            if (! $this->identityChecker->isUnique($jobId)) {
                throw JobFeedAlreadyExist::withId($jobId);
            }

            $jobFeed = JobFeed::create($item->title(), $item->description(), $item->link(), new \DateTimeImmutable($item->publicationDate()), $jobId);

            $this->repository->save($jobFeed);
        }
    }
}
