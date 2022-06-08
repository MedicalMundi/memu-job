<?php declare(strict_types=1);

namespace App\Tests\Functional\Publishing;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontHomeControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function homePageShouldBeAccessible(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
