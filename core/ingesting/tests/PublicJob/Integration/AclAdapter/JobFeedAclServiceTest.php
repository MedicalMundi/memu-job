<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\AclAdapter;

use Ingesting\PublicJob\AclAdapter\IngestinOutgoinAcl;
use Ingesting\PublicJob\AclAdapter\InProcess\IngestingAclService;
use Ingesting\PublicJob\AclAdapter\Repository\DistributableJobFeedRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @covers \Ingesting\PublicJob\AclAdapter\IngestingAclService
 */
class JobFeedAclServiceTest extends KernelTestCase
{
    private ?IngestinOutgoinAcl $aclService;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = parent::bootKernel();
        $repository = $kernel->getContainer()
            ->get(DistributableJobFeedRepository::class);

        $this->aclService = new IngestingAclService($repository);
    }

    public function testName(): void
    {
        \assert(null !== $this->aclService);
        self::assertEmpty($this->aclService->getPublishedToday());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->aclService = null;
    }
}
