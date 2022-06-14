<?php declare(strict_types=1);

namespace App\Tests\E2E\Backoffice;

use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

class BackofficeTest extends PantherTestCase
{
    protected ?Client $client = null;

    public function setUp(): void
    {
        $this->client = static::createPantherClient([
            'browser' => static::FIREFOX,
        ]);
    }

//    /**
//     * @test
//     */
//    public function backofficeHomePageShouldBeAccessibile(): void
//    {
//        self::markTestSkipped();
//        $this->client->request('GET', '/');
//
//        $this->client->waitForElementToContain('.head-line', 'Backoffice');
//    }

    public function tearDown(): void
    {
        $this->client = null;
    }
}
