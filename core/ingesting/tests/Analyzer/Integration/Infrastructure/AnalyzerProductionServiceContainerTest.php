<?php declare(strict_types=1);

namespace Ingesting\Tests\Analyzer\Integration\Infrastructure;

use Ingesting\Analyzer\Infrastructure\ProductionServiceContainer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\Analyzer\Infrastructure\ProductionServiceContainer
 */
class AnalyzerProductionServiceContainerTest extends TestCase
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
