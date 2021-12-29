<?php declare(strict_types=1);

namespace Ingesting\Errata\Adapter\Rss;

use FeedIo\Factory;
use FeedIo\Feed;
use FeedIo\FeedIo;
use FeedIo\Reader\Result;
use Ingesting\Errata\Application\Iso\RssReader;

class FeedIoRssReader implements RssReader
{
    private const GAZZETTA_UFFICIALE_FEED_URL = 'https://www.gazzettaufficiale.it/rss/S4';

    private FeedIo $feedIo;

    private string $feedUrl;

    public function __construct(?FeedIo $feedIo = null, ?string $feedUrl = null)
    {
        $this->feedIo = $feedIo ?? Factory::create()->getFeedIo();
        $this->feedUrl = $feedUrl ?? self::GAZZETTA_UFFICIALE_FEED_URL;
    }

    public function readRssFeed(): array
    {
        $data = $this->feedIo->read($this->feedUrl);

        return $this->formatOutput($data);
    }

    private function formatOutput(Result $result): array
    {
        $feedItems = [];
        /** @var Feed $item */
        foreach ($result->getFeed() as $item) {
            $feed = RssDataItem::create(
                $item->getTitle(),
                ($item->getAllElements()[0])->getValue(),
                $item->getLink(),
                $item->getLastModified()->format('Y-m-d H:i:s')
            );
            $feedItems[] = $feed;
        }
        return $feedItems;
    }
}
