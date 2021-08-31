<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\Infrastructure;

use Ingesting\PublicJob\Infrastructure\ProductionServiceContainer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\PublicJob\Infrastructure\ProductionServiceContainer
 */
class PublicJobProductionServiceContainerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBuildAnalyzerModule(): void
    {
        self::expectNotToPerformAssertions();

        $moduleContainer = new ProductionServiceContainer();
        $moduleContainer->module();
    }
}
