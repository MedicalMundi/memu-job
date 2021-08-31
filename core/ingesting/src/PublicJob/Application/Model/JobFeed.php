<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model;

use Ingesting\SharedKernel\Model\PublicationDate;

class JobFeed
{
    private JobId $id;

    private string $title;

    private string $description;

    private string $link;

    private PublicationDate $publicationDate;

    private function __construct(JobId $id)
    {
        $this->id = $id;
    }

    public static function create(string $title, string $description, string $link, string $pubDate, ?JobId $id = null): self
    {
        $identity = $id ?? JobId::generate();
        $errata = new self($identity);

        $errata->title = $title;
        $errata->description = $description;
        $errata->link = $link;

        //TODO ramdomness in domain?
        //TODO orario italiano usare clock?
        $errata->publicationDate = PublicationDate::fromString((new \DateTimeImmutable($pubDate))->format('Y-m-d H:i:s'));

        return $errata;
    }

    public function id(): JobId
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
