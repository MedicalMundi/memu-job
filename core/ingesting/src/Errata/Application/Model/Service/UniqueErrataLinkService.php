<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model\Service;

use Ingesting\Errata\Application\Model\ErrataFeedRepository;

class UniqueErrataLinkService implements UniqueLink
{
    private ErrataFeedRepository $repository;

    public function __construct(ErrataFeedRepository $repository)
    {
        $this->repository = $repository;
    }

    public function isUniqueLink(string $errataLink): bool
    {
        return $this->repository->isUniqueLink($errataLink);
    }
}
