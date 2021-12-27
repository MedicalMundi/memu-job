<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\RssReader;

use Ingesting\PublicJob\Adapter\Rss\FeedIoRssReader;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\PublicJob\Adapter\Rss\FeedIoRssReader
 * @group io-network
 */
class FeedIoRssReaderTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_download_rss_feeds(): void
    {
        $reader = new FeedIoRssReader();

        $result = $reader->readRssFeed();

        self::assertNotEmpty($result);
    }
}
