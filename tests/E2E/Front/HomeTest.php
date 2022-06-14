<?php declare(strict_types=1);

namespace App\Tests\E2E\Front;

use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

class HomeTest extends PantherTestCase
{
    protected ?Client $client = null;

    public function setUp(): void
    {
        $this->client = static::createPantherClient([
            'browser' => static::FIREFOX,
        ]);
    }

    /**
     * @test
     */
    public function frontHomePageShouldBeAccessibile(): void
    {
        $this->client->request('GET', '/');

        $this->client->waitFor('.bi-heart');

        $this->client->waitForElementToContain('.head-line', 'Welcome to MedicalMundi!');
    }

    public function tearDown(): void
    {
        $this->client = null;
    }
}
