<?php declare(strict_types=1);

namespace App\Tests\Integration\RouterSnapShot;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\RouteCollection;

class RouterSnapShotTest extends KernelTestCase
{
    public function test(): void
    {
        $container = $this->getContainer();

        $router = $container->get('router');

        $routeCollection = $router->getRouteCollection();
        $routeMap = $this->createRouteMap($routeCollection);

        $currentRouteMapJson = json_encode($routeMap, JSON_PRETTY_PRINT); //  Json::encode($routeMap, Json::PRETTY);

        $expectedRouteMapFile = __DIR__ . '/Fixture/expected_route_map.json';

        if (getenv('UT')) {
            (new FileSystem())->dumpFile($expectedRouteMapFile, $currentRouteMapJson);
        }

        $this->assertJsonStringEqualsJsonFile(
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
