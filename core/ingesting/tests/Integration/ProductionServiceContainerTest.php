<?php declare(strict_types=1);

namespace Ingesting\Tests\Integration;

use Ingesting\Errata\Infrastructure\ProductionServiceContainer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\Errata\Infrastructure\ProductionServiceContainer
 * @group quarantine
 */
class ProductionServiceContainerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBuildErrataModule(): void
    {
        self::expectNotToPerformAssertions();

        $moduleContainer = new ProductionServiceContainer();
        $moduleContainer->module();
    }
}
