<?php declare(strict_types=1);

namespace App\Tests\E2E;

use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

class FirefoxPlaceholderTest extends PantherTestCase
{
    /**
     * @test
     */
    public function frontPageShouldBeAccessible(): void
    {
        // Error in ci
        //  - RuntimeException: The port 4444 is already in use.

        // Errors in local
        //  - RuntimeException: The port 4444 is already in use.
        //  - Operation timed out after 30000 milliseconds with 0 bytes received
//        $client = Client::createFirefoxClient(
//            null,
//            null,
//            [
//                //'hostname' => 'http://127.0.0.1/',
//                // Defaults to 127.0.0.1
//                //'port' => 8080, // Defaults to 9080
//            ],
//            'http://127.0.0.1'
//        );

        $client = static::createPantherClient(
            [
                'browser' => static::FIREFOX,
            ]
        );

        $client->request('GET', 'http://127.0.0.1');

        self::assertSame('http://127.0.0.1/', $client->getCurrentURL());
    }

    /**
     * @test
     */
    public function systemStatusPageShouldBeAccessible(): void
    {
        $client = static::createPantherClient(
            [
                'browser' => static::FIREFOX,
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
