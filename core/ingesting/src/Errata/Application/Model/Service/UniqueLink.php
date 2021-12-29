<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model\Service;

interface UniqueLink
{
    public function isUniqueLink(string $errataLink): bool;
}
