<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model;

use DateTimeImmutable;

class JobFeed
{
    private string $title;

    private string $description;

    private string $link;

    private DateTimeImmutable $publicationDate;

    private function __construct(
        private JobId $id
    ) {
    }

    public static function create(string $title, string $description, string $link, DateTimeImmutable $pubDate, ?JobId $id = null): self
    {
        $identity = $id ?? JobId::generate();
        $job = new self($identity);

        $job->title = $title;
        $job->description = $description;
        $job->link = $link;
        $job->publicationDate = $pubDate;

        return $job;
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

    public function publicationDate(): DateTimeImmutable
    {
        return $this->publicationDate;
    }
}
