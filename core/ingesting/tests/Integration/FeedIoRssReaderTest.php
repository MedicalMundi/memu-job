<?php declare(strict_types=1);

namespace Ingesting\Tests\Integration;

use Ingesting\Errata\Adapter\Rss\FeedIoRssReader;
use PHPUnit\Framework\TestCase;

/**
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
