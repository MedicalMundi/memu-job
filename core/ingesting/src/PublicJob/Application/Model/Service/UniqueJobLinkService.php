<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model\Service;

use Ingesting\PublicJob\Application\Model\JobRepository;

class UniqueJobLinkService implements UniqueLink
{
    private JobRepository $repository;

    public function __construct(JobRepository $repository)
    {
        $this->repository = $repository;
    }

    public function isUniqueLink(string $jobLink): bool
    {
        return $this->repository->isUniqueLink($jobLink);
    }
}
