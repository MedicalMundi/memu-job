<?php declare(strict_types=1);

namespace Ingesting\PublicJob\AclAdapter;

class JobFeedAclService implements JobFeedOutgoinAcl
{
    private DistributableJobFeedRepository $repository;

    public function __construct(DistributableJobFeedRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getPublishedToday(): array
    {
        return $this->repository->getTodayData();
    }
}
