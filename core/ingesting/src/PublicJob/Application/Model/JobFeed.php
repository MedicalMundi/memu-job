<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model;

use DateTimeImmutable;
use Ingesting\SharedKernel\Model\PublicationDate;

class JobFeed
{
    private JobId $id;

    private string $title;

    private string $description;

    private string $link;

    private DateTimeImmutable $publicationDate;

    private function __construct(JobId $id)
    {
        $this->id = $id;
    }

    public static function create(string $title, string $description, string $link, DateTimeImmutable $pubDate, ?JobId $id = null): self
    {
        $identity = $id ?? JobId::generate();
        $job = new self($identity);

        $job->title = $title;
        $job->description = $description;
        $job->link = $link;

        //TODO ramdomness in domain?
        //TODO orario italiano usare clock?
        //$job->publicationDate = PublicationDate::fromString((new \DateTimeImmutable($pubDate))->format('Y-m-d H:i:s'));
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
