<?php declare(strict_types=1);

namespace Ingesting\Tests\Errata\Integration\Infrastructure;

use Ingesting\Errata\Adapter\Persistence\Doctrine\DoctrineErrataFeedRepository;
use Ingesting\Errata\Infrastructure\ProductionServiceContainer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @covers \Ingesting\Errata\Infrastructure\ProductionServiceContainer
 * @group quarantine
 */
class ProductionServiceContainerTest extends KernelTestCase
{
    private ?object $errataFeedRepository = null;

    protected function setUp(): void
    {
        $kernel = parent::bootKernel();

        $this->errataFeedRepository = $kernel->getContainer()
            ->get(DoctrineErrataFeedRepository::class);

        parent::setUp();
    }

    /**
     * @test
     */
    public function shouldBuildErrataModule(): void
    {
        self::expectNotToPerformAssertions();

        $moduleContainer = new ProductionServiceContainer(
            $this->errataFeedRepository
        );
        $moduleContainer->module();
    }

    protected function tearDown(): void
    {
        $this->errataFeedRepository = null;
    }
}
