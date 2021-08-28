<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Domain\Model\Service;

use Ingesting\Errata\Application\Domain\Model\ErrataId;

interface UniqueErrataIdentity
{
    public function isUnique(ErrataId $id): bool;
}
