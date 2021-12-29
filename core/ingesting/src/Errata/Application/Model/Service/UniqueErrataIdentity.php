<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model\Service;

use Ingesting\Errata\Application\Model\ErrataId;

interface UniqueErrataIdentity
{
    public function isUnique(ErrataId $id): bool;
}
