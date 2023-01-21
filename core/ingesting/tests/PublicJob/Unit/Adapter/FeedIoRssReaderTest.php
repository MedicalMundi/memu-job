<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Unit\Adapter;

use FeedIo\FeedIo;
use Ingesting\Errata\Adapter\Rss\FeedIoRssReader;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\PublicJob\Adapter\Rss\FeedIoRssReader
 */
class FeedIoRssReaderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReadRssFeedFromDataSource(): void
    {
        $feedIoMock = $this->getMockBuilder(FeedIo::class)
            ->disableOriginalConstructor()
            ->getMock();

        $feedIoMock->expects(self::once())
            ->method('read')
            ->with('https://www.afeedurl.com')
        ;

        $rssReader = new FeedIoRssReader($feedIoMock, 'https://www.afeedurl.com');

        $rssReader->readRssFeed();
    }
}
