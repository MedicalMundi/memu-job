<?php declare(strict_types=1);

namespace App\Tests\E2E\Backoffice;

use Symfony\Component\Panther\PantherTestCase;

class BackofficeTest extends PantherTestCase
{
    protected $client = null;

    public function setUp(): void
    {
        $this->client = static::createPantherClient([
            'browser' => static::FIREFOX,
        ]);
    }

    /**
     * @test
     */
    public function backofficeHomePageShouldBeAccessibile(): void
    {
        $this->client->request('GET', '/');

        self::assertResponseIsSuccessful();
    }

    public function tearDown(): void
    {
        $this->client = null;
    }
}
