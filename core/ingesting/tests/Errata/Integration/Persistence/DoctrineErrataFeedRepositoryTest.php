<?php declare(strict_types=1);

namespace Ingesting\Tests\Errata\Integration\Persistence;

use Ingesting\Errata\Application\Model\ErrataFeedRepository;

/**
 * @covers \Ingesting\Errata\Adapter\Persistence\Doctrine\DoctrineErrataFeedRepository
 * @group io-database
 */
class DoctrineErrataFeedRepositoryTest extends ErrataFeedRepositoryContractTest
{
    /**
     * @var null|object
     */
    private $doctrineErrataFeedRepository;

    protected function setUp(): void
    {
        $kernel = parent::bootKernel();

        $this->doctrineErrataFeedRepository = $kernel->getContainer()
            ->get('Ingesting\Errata\Adapter\Persistence\Doctrine\DoctrineErrataFeedRepository');

        parent::setUp();
    }

    protected function createRepository(): ErrataFeedRepository
    {
        return $this->doctrineErrataFeedRepository;
    }

    protected function tearDown(): void
    {
        $this->doctrineErrataFeedRepository = null;
    }
}
