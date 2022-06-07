<?php declare(strict_types=1);

namespace App\Tests\E2E;

use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

class ChromePlaceholderTest extends PantherTestCase
{
    /**
     * @test
     */
    public function systemStatusPageShouldBeAccessible(): void
    {
        $client = Client::createChromeClient();

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
                'browser' => static::CHROME,
            ]
        );

        $client->request('GET', '/sys/healt/check');

        self::assertSame('http://127.0.0.1:9080/sys/healt/check', $client->getCurrentURL());
    }
}
