<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\Persistence;

use Ingesting\PublicJob\Adapter\Persistence\InMemoryJobFeedRepository;
use Ingesting\PublicJob\Application\Model\JobRepository;

class InMemoryJobRepositoryTest extends JobRepositoryContractTest
{
    protected function createRepository(): JobRepository
    {
        return new InMemoryJobFeedRepository();
    }
}
