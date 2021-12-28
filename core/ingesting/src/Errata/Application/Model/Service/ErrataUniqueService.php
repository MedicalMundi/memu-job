<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model\Service;

use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\ErrataId;

class ErrataUniqueService implements UniqueErrataIdentity
{
    private ErrataFeedRepository $repository;

    public function __construct(ErrataFeedRepository $repository)
    {
        $this->repository = $repository;
    }

    public function isUnique(ErrataId $id): bool
    {
        return $this->repository->isUniqueIdentity($id);
    }
}
