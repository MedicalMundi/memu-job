<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\Persistence\ReadableJobRepository;

use Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineJobFeedRepository;
use Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineReadableJobFeedRepository;
use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Usecase\ReadableJobFeedRepository;

/**
 * @covers \Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineReadableJobFeedRepository
 * @group io-database
 */
class DoctrineReadableJobRepositoryTest extends ReadableJobRepositoryContractTest
{
    private ?ReadableJobFeedRepository $doctrineReadableJobFeedRepository;

    private DoctrineJobFeedRepository$writeModel;

    protected function setUp(): void
    {
        $kernel = parent::bootKernel();
        $this->doctrineReadableJobFeedRepository = $kernel->getContainer()
            ->get(DoctrineReadableJobFeedRepository::class);

        $this->writeModel = $kernel->getContainer()
            ->get(DoctrineJobFeedRepository::class);

        parent::setUp();
    }

    protected function createRepository(): ReadableJobFeedRepository
    {
        \assert($this->doctrineReadableJobFeedRepository instanceof DoctrineReadableJobFeedRepository);
        return $this->doctrineReadableJobFeedRepository;
    }

    protected function loadFixtures(array $fixtures): void
    {
        /** @var JobFeed $fixture */
        foreach ($fixtures as $fixture) {
            $this->writeModel->save($fixture);
        }
    }

    protected function tearDown(): void
    {
        $this->doctrineReadableJobFeedRepository = null;
    }
}
