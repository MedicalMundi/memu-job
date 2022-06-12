<?php declare(strict_types=1);

namespace App\Tests\E2E;

use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

class ChromePlaceholderTest extends PantherTestCase
{
    /**
     * @test
     */
    public function frontPageShouldBeAccessible(): void
    {
        $client = Client::createChromeClient();

        $client->request('GET', 'http://127.0.0.1');

        self::assertSame('http://127.0.0.1/', $client->getCurrentURL());
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

    /**
     * @test
     */
    public function backofficePageShouldBeAccessible(): void
    {
        $client = static::createPantherClient(
            [
                'browser' => static::FIREFOX,
            ]
        );

        $client->request('GET', '/backoffice');

        self::assertSame('http://127.0.0.1:9080/backoffice', $client->getCurrentURL());
    }
}
