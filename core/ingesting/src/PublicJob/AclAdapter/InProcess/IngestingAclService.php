<?php declare(strict_types=1);

namespace Ingesting\PublicJob\AclAdapter\InProcess;

use Ingesting\PublicJob\AclAdapter\IngestinOutgoinAcl;
use Ingesting\PublicJob\AclAdapter\Repository\DistributableJobFeedRepository;

class IngestingAclService implements IngestinOutgoinAcl
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
