<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\Persistence\ReadableJobRepository;

use Ingesting\PublicJob\Adapter\Persistence\InMemoryReadableJobFeedRepository;
use Ingesting\PublicJob\Application\Usecase\ReadableJobFeedRepository;

/**
 * @covers \Ingesting\PublicJob\Adapter\Persistence\InMemoryReadableJobFeedRepository
 */
class InMemoryReadableJobRepositoryTest extends ReadableJobRepositoryContractTest
{
    protected ReadableJobFeedRepository $repository;

    protected function createRepository(): ReadableJobFeedRepository
    {
        return InMemoryReadableJobFeedRepository::withData([]);
    }

    protected function loadFixtures(array $fixtures): void
    {
        $this->repository = InMemoryReadableJobFeedRepository::withData($fixtures);
    }
}
