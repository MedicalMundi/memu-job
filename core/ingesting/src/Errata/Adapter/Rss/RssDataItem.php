<?php declare(strict_types=1);

namespace Ingesting\Errata\Adapter\Rss;

use Ingesting\Errata\Application\Iso\RssData;

class RssDataItem implements RssData
{
    private string $title;

    private string $description;

    private string $link;

    private string $pubDate;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getPubDate(): string
    {
        return $this->pubDate;
    }

    public function setPubDate(string $pubDate): void
    {
        $this->pubDate = $pubDate;
    }
}
