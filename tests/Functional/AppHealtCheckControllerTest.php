<?php declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppHealtCheckControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function systemStatusPageShouldBeAccessible(): void
    {
        $client = static::createClient();

        $client->request('GET', '/sys/healt/check');

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
