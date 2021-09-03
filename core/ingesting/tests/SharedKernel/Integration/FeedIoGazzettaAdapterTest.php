<?php declare(strict_types=1);

namespace Ingesting\Tests\SharedKernel\Integration;

use FeedIo\FeedIo;
use Ingesting\SharedKernel\Infrastructure\FeedIoAdapter\GazzettaClient;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\HttpClient;

/**
 * @covers \Ingesting\SharedKernel\Infrastructure\FeedIoAdapter\GazzettaClient
 */
class FeedIoGazzettaAdapterTest extends TestCase
{
    /**
     * @test
     * @group io-network
     */
    public function testGazzettaRssEndpoint(): void
    {
        self::doesNotPerformAssertions();
        $url = 'https://www.gazzettaufficiale.it/rss/S4';

        $symfonyClient = HttpClient::create([
            'verify_peer' => true,
            'verify_host' => true,
        ]);

        $gazzettaClient = new GazzettaClient($symfonyClient, '');

        $logger = new NullLogger();

        $feedIo = new FeedIo($gazzettaClient, $logger);

        $x = $feedIo->read($url);
    }
}
