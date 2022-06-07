<?php declare(strict_types=1);

namespace App\Tests\E2E;

use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

class FirefoxPlaceholderTest extends PantherTestCase
{
    /**
     * @test
     */
    public function systemStatusPageShouldBeAccessible(): void
    {
        $client = Client::createFirefoxClient(
            null,
            null,
            [
                //'hostname' => 'http://127.0.0.1/',
                // Defaults to 127.0.0.1
                //'port' => 8080, // Defaults to 9080
            ],
            'http://127.0.0.1'
        );

        $client->request('GET', 'http://127.0.0.1/sys/healt/check');

        self::assertSame('http://127.0.0.1/sys/healt/check', $client->getCurrentURL());
    }

    /**
     * @test
     */
    public function systemStatusPageShouldBeAccessible002(): void
    {
        $client = static::createPantherClient(
            [
                'browser' => static::FIREFOX,
            ]
        );

        $client->request('GET', '/sys/healt/check');

        self::assertSame('http://127.0.0.1:9080/sys/healt/check', $client->getCurrentURL());
    }
}
