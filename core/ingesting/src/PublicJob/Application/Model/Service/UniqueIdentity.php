<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model\Service;

use Ingesting\PublicJob\Application\Model\JobId;

interface UniqueIdentity
{
    public function isUnique(JobId $id): bool;
}
