<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model\Service;

use Ingesting\PublicJob\Application\Model\JobId;
use Ingesting\PublicJob\Application\Model\JobRepository;

class JobUniqueService implements UniqueIdentity
{
    private JobRepository $repository;

    public function __construct(JobRepository $repository)
    {
        $this->repository = $repository;
    }

    public function isUnique(JobId $id): bool
    {
        return $this->repository->isUniqueIdentity($id);
    }
}
