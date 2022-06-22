<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\Persistence\JobRepository;

use Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineJobFeedRepository;
use Ingesting\PublicJob\Application\Model\JobRepository;

/**
 * @covers \Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineJobFeedRepository
 * @group io-database
 */
class DoctrineJobRepositoryTest extends JobRepositoryContractTest
{
    private ?JobRepository $doctrineJobFeedRepository;

    protected function setUp(): void
    {
        $kernel = parent::bootKernel();
        $this->doctrineJobFeedRepository = $kernel->getContainer()
            ->get(DoctrineJobFeedRepository::class);

        parent::setUp();
    }

    protected function createRepository(): JobRepository
    {
        \assert($this->doctrineJobFeedRepository instanceof DoctrineJobFeedRepository);
        return $this->doctrineJobFeedRepository;
    }

    protected function tearDown(): void
    {
        $this->doctrineJobFeedRepository = null;
    }
}
