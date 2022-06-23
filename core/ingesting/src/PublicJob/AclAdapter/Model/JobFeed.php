<?php declare(strict_types=1);

namespace Ingesting\PublicJob\AclAdapter\Model;

class JobFeed implements DistributableJobFeed
{
    private string $identity;

    private string $title;

    private string $description;

    private string $link;

    public function __construct(string $identity, string $title, string $description, string $link)
    {
        $this->identity = $identity;
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
    }

    /**
     * @param array<array-key, mixed> $item
     */
    public static function fromArray(array $item): self
    {
        // TODO USE ASSERT LIBRARY
        // CHECK array key

        return new self(
            (string) $item['job_id'],
            (string) $item['title'],
            (string) $item['description'],
            (string) $item['link'],
        );
    }

    public function identity(): string
    {
        return $this->identity;
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
}
