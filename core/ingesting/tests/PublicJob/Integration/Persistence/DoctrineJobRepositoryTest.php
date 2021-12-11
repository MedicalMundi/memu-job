<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\Persistence;

use Ingesting\PublicJob\Application\Model\JobRepository;

/**
 * @covers \Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineJobFeedRepository
 */
class DoctrineJobRepositoryTest extends JobRepositoryContractTest
{
    /**
     * @var null|object
     */
    private $doctrineJobFeedRepository;

    protected function setUp(): void
    {
        $kernel = parent::bootKernel();

        $this->doctrineJobFeedRepository = $kernel->getContainer()
            ->get('Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineJobFeedRepository');

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
