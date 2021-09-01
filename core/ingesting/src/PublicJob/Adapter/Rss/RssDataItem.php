<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Adapter\Rss;

use Ingesting\PublicJob\Application\Model\Iso\RssData;

class RssDataItem implements RssData
{
    private string $title;

    private string $description;

    private string $link;

    private string $publicationDate;

    public static function create(string $title, string $description, string $link, string $publicationDate): self
    {
        $self = new self();
        $self->title = $title;
        $self->description = $description;
        $self->link = $link;
        $self->publicationDate = $publicationDate;

        return $self;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function link(): string
    {
        return $this->link;
    }

    public function publicationDate(): string
    {
        return $this->publicationDate;
    }
}
