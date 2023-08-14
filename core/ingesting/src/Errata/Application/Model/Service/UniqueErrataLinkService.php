<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model\Service;

use Ingesting\Errata\Application\Model\ErrataFeedRepository;

class UniqueErrataLinkService implements UniqueLink
{
    public function __construct(
        private ErrataFeedRepository $repository
    ) {
    }

    public function isUniqueLink(string $errataLink): bool
    {
        return $this->repository->isUniqueLink($errataLink);
    }
}
