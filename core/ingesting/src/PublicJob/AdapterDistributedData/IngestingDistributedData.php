<?php declare(strict_types=1);

namespace Ingesting\PublicJob\AdapterDistributedData;

use Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineJobFeedRepository;
use Ingesting\PublicJob\Application\Model\JobId;

class IngestingDistributedData
{
    public function __construct(
        private DoctrineJobFeedRepository $jobFeedRepository
    ) {
    }

    public function findAllJobFeed(): array
    {
        return $this->jobFeedRepository->findAll();
    }

    public function findJobFeedById(string $id): array
    {
        return [
            $this->jobFeedRepository->findOneBy([
                'id' => JobId::fromString($id),
            ]),
        ];
    }
}
