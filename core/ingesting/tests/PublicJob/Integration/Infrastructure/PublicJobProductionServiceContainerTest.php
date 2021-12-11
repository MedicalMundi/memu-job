<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\Infrastructure;

use Ingesting\PublicJob\Application\Model\JobRepository;
use Ingesting\PublicJob\Infrastructure\ProductionServiceContainer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @covers \Ingesting\PublicJob\Infrastructure\ProductionServiceContainer
 * @group quarantine
 */
class PublicJobProductionServiceContainerTest extends KernelTestCase
{
    /**
     * @var JobRepository
     */
    private $jobRepository;

    protected function setUp(): void
    {
        $kernel = parent::bootKernel();

        $this->jobRepository = $kernel->getContainer()
            ->get('Ingesting\PublicJob\Adapter\Persistence\Doctrine\DoctrineJobFeedRepository');

        parent::setUp();
    }

    /**
     * @test
     */
    public function shouldBuildPublicJobModule(): void
    {
        self::expectNotToPerformAssertions();

        $moduleContainer = new ProductionServiceContainer(
            $this->jobRepository
        );
        $moduleContainer->module();
    }

    protected function tearDown(): void
    {
        $this->jobRepository = null;
    }
}
