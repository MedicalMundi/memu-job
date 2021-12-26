<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model\Service;

use Ingesting\Errata\Application\Model\CouldNotFindErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\ErrataId;

class ErrataUniqueService implements \Ingesting\Errata\Application\Model\Service\UniqueErrataIdentity
{
    private ErrataFeedRepository $repository;

    public function __construct(ErrataFeedRepository $repository)
    {
        $this->repository = $repository;
    }

    public function isUnique(ErrataId $id): bool
    {
        try {
            $this->repository->withId($id);
            $result = false;
        } catch (CouldNotFindErrataFeed $e) {
            // silent exception
            $result = true;
        }

        return $result;
    }
}
