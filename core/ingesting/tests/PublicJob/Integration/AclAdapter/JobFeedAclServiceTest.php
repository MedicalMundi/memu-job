<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\AclAdapter;

use Ingesting\PublicJob\AclAdapter\DistributableJobFeedRepository;
use Ingesting\PublicJob\AclAdapter\JobFeedAclService;
use Ingesting\PublicJob\AclAdapter\JobFeedOutgoinAcl;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @covers \Ingesting\PublicJob\AclAdapter\JobFeedAclService
 */
class JobFeedAclServiceTest extends KernelTestCase
{
    private ?JobFeedOutgoinAcl $service;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = parent::bootKernel();
        $repository = $kernel->getContainer()
            ->get(DistributableJobFeedRepository::class);

        $this->service = new JobFeedAclService($repository);
    }

    public function testName(): void
    {
        self::assertEmpty($this->service->getPublishedToday());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->service = null;
    }
}
