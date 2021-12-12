<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model\Service;

interface UniqueLink
{
    public function isUniqueLink(string $jobLink): bool;
}
