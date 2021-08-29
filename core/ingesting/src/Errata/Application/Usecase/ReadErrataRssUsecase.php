<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Usecase;

use Ingesting\Errata\Application\Domain\Model\ErrataFeed;
use Ingesting\Errata\Application\Domain\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Domain\Model\ErrataId;
use Ingesting\Errata\Application\Domain\Model\Service\ErrataUniqueService;
use Ingesting\Errata\Application\Iso\RssData;
use Ingesting\Errata\Application\Iso\RssReader;

class ReadErrataRssUsecase implements ErrataRssDataSoureChecker
{
    private ErrataFeedRepository $repository;

    private ErrataUniqueService $errataUniqueService;

    private RssReader $rssReader;

    public function __construct(ErrataFeedRepository $repository, ErrataUniqueService $errataUniqueService, rssReader $rssReader)
    {
        $this->repository = $repository;
        $this->errataUniqueService = $errataUniqueService;
        $this->rssReader = $rssReader;
    }

    public function readErrataRssDataSource(): void
    {
        $downloadedItem = $this->rssReader->readRssFeed();

        /** @var RssData $item */
        foreach ($downloadedItem as $item) {

            //Todo ramdomness in domain (unpredictable test/assertion)
            $errataId = ErrataId::generate();

            if (! $this->errataUniqueService->isUnique($errataId)) {
                // todo add custom exception with message 'xxx with id x already exist/used'
                throw new \RuntimeException('Id exist');
            }

            $errataFeed = ErrataFeed::create($item->title(), $item->description(), $item->link(), $item->publicationDate(), $errataId);

            $this->repository->save($errataFeed);
        }
    }
}
