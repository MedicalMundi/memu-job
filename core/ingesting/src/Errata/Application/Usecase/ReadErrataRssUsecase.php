<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Usecase;

use Ingesting\Errata\Application\Iso\RssData;
use Ingesting\Errata\Application\Iso\RssReader;
use Ingesting\Errata\Application\Model\ErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeedAlreadyExist;
use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\ErrataId;
use Ingesting\Errata\Application\Model\Service\ErrataUniqueService;
use Ingesting\Errata\Application\Model\Service\UniqueLink;

class ReadErrataRssUsecase implements ErrataRssDataSoureChecker
{
    private ErrataFeedRepository $repository;

    private ErrataUniqueService $errataUniqueService;

    private UniqueLink $uniqueLinkDetector;

    private RssReader $rssReader;

    public function __construct(ErrataFeedRepository $repository, ErrataUniqueService $errataUniqueService, UniqueLink $uniqueLinkDetector, rssReader $rssReader)
    {
        $this->repository = $repository;
        $this->errataUniqueService = $errataUniqueService;
        $this->uniqueLinkDetector = $uniqueLinkDetector;
        $this->rssReader = $rssReader;
    }

    public function readErrataRssDataSource(): void
    {
        $downloadedItem = $this->rssReader->readRssFeed();

        /** @var RssData $item */
        foreach ($downloadedItem as $item) {
            if (! $this->uniqueLinkDetector->isUniqueLink($item->link())) {
                return;
            }

            $errataId = ErrataId::generate();

            if (! $this->errataUniqueService->isUnique($errataId)) {
                throw ErrataFeedAlreadyExist::withId($errataId);
            }

            $errataFeed = ErrataFeed::create($item->title(), $item->description(), $item->link(), new \DateTimeImmutable($item->publicationDate()), $errataId);

            $this->repository->save($errataFeed);
        }
    }
}
