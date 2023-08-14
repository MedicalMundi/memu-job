<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model\Service;

use Ingesting\PublicJob\Application\Model\JobRepository;

class UniqueJobLinkService implements UniqueLink
{
    public function __construct(
        private JobRepository $repository
    ) {
    }

    public function isUniqueLink(string $jobLink): bool
    {
        return $this->repository->isUniqueLink($jobLink);
    }
}
