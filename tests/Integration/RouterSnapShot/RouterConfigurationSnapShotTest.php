<?php declare(strict_types=1);

namespace App\Tests\Integration\RouterSnapShot;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;

/**
 * Snapshot test about the router configuration
 *
 * When you add new route run phpunit with env var UT=1 (Update Test)
 * UT=1 bin/phpunit --filter=RouterConfigurationSnapShotTest --group regression
 *
 * @group regression
 * @coversNothing
 */
class RouterConfigurationSnapShotTest extends KernelTestCase
{
    public function testRouterConfigurationEndPoint(): void
    {
        /** @var ContainerInterface $container */
        $container = self::getContainer();

        /** @var RouterInterface $router */
        $router = $container->get('router');

        $routeCollection = $router->getRouteCollection();

        $routeMap = $this->createRouteMap($routeCollection);

        $currentRouteMapJson = (string) json_encode($routeMap, JSON_PRETTY_PRINT); //  Json::encode($routeMap, Json::PRETTY);

        $expectedRouteMapFile = __DIR__ . '/Fixture/expected_route_map.json';

        if ((bool) getenv('UT')) {
            (new Filesystem())->dumpFile($expectedRouteMapFile, $currentRouteMapJson);
        }

        self::assertJsonStringEqualsJsonFile(
            $expectedRouteMapFile,
            $currentRouteMapJson
        );
    }

    private function createRouteMap(RouteCollection $routeCollection): array
    {
        $routeMap = [];
        foreach ($routeCollection->all() as $name => $route) {
            $routeMap[$name] = [
                'path' => $route->getPath(),
                'requirements' => $route->getRequirements(),
                'defaults' => $route->getDefaults(),
                'methods' => $route->getMethods(),
            ];
        }

        ksort($routeMap);

        return $routeMap;
    }
}
