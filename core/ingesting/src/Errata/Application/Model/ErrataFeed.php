<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model;

use Ingesting\SharedKernel\Model\PublicationDate;

class ErrataFeed
{
    private ErrataId $id;

    private string $title;

    private string $description;

    private string $link;

    private PublicationDate $publicationDate;

    private function __construct(ErrataId $id)
    {
        $this->id = $id;
    }

    public static function create(string $title, string $description, string $link, string $pubDate, ?ErrataId $id = null): self
    {
        $identity = $id ?? ErrataId::generate();
        $errata = new ErrataFeed($identity);

        $errata->title = $title;
        $errata->description = $description;
        $errata->link = $link;

        //TODO orario italiano?
        $errata->publicationDate = PublicationDate::fromString((new \DateTimeImmutable($pubDate))->format('Y-m-d H:i:s'));

        return $errata;
    }

    public function id(): ErrataId
    {
        return $this->id;
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

    public function publicationDate(): PublicationDate
    {
        return $this->publicationDate;
    }
}
