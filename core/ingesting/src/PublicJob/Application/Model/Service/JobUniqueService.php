<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model\Service;

use Ingesting\PublicJob\Application\Model\CouldNotFindJobFeed;
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
        try {
            $this->repository->withId($id);
            $result = false;
        } catch (CouldNotFindJobFeed $e) {
            // silent exception
            $result = true;
        }

        return $result;
    }
}
