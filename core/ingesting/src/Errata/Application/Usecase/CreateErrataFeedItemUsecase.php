<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Usecase;

use Ingesting\Errata\Application\Domain\Model\ErrataFeed;
use Ingesting\Errata\Application\Domain\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Domain\Model\ErrataId;
use Ingesting\Errata\Application\Domain\Model\Service\ErrataUniqueService;

class CreateErrataFeedItemUsecase implements CreateErrataFeedItem
{
    private ErrataFeedRepository $repository;

    private ErrataUniqueService $errataUniqueService;

    public function __construct(ErrataFeedRepository $repository, ErrataUniqueService $errataUniqueService)
    {
        $this->repository = $repository;
        $this->errataUniqueService = $errataUniqueService;
    }

    public function createErrataFeed(string $title, string $description, string $link, string $pubDate, ?ErrataId $uuidIdentifier = null): void
    {
        $errataId = $uuidIdentifier ?? ErrataId::generate();

        if (! $this->errataUniqueService->isUnique($errataId)) {
            // todo add custom exception with message 'xxx with id x already exist/used'
            throw new \RuntimeException('Id exist');
        }

        $errataFeed = ErrataFeed::create($title, $description, $link, $pubDate, $errataId);

        $this->repository->save($errataFeed);
    }
}
