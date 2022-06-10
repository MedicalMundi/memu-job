<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\Persistence;

use Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineJobFeedRepository;
use Ingesting\PublicJob\Application\Model\JobRepository;

/**
 * @covers \Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineJobFeedRepository
 * @group io-database
 */
class DoctrineJobRepositoryTest extends JobRepositoryContractTest
{
    private ?object $doctrineJobFeedRepository;

    protected function setUp(): void
    {
        $kernel = parent::bootKernel();

        $this->doctrineJobFeedRepository = $kernel->getContainer()
            ->get(DoctrineJobFeedRepository::class);

        parent::setUp();
    }

    protected function createRepository(): JobRepository
    {
        return $this->doctrineJobFeedRepository;
    }

    protected function tearDown(): void
    {
        $this->doctrineJobFeedRepository = null;
    }
}
