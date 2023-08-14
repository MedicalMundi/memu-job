<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model\Service;

use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\ErrataId;

class ErrataUniqueService implements UniqueErrataIdentity
{
    public function __construct(
        private ErrataFeedRepository $repository
    ) {
    }

    public function isUnique(ErrataId $id): bool
    {
        return $this->repository->isUniqueIdentity($id);
    }
}
