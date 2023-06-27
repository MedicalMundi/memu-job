<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Adapter\Persistence;

use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Usecase\ReadableJobFeedRepository;

class InMemoryReadableJobFeedRepository implements ReadableJobFeedRepository
{
    private InMemoryJobFeedRepository $writeModel;

    private function __construct(InMemoryJobFeedRepository $writeModel = null)
    {
        $this->writeModel = $writeModel ?? new InMemoryJobFeedRepository();
    }

    public static function withData(array $items = []): self
    {
        $repository = new self();
        /** @var JobFeed $item */
        foreach ($items as $item) {
            $repository->writeModel->save($item);
        }

        return $repository;
    }

    public function listAvailableJobFeed(): array
    {
        $result = [];
        /** @var JobFeed $item */
        foreach ($this->writeModel->items() as $item) {
            $result[] = $this->formatItem($item);
        }

        return $result;
    }

    private function formatItem(JobFeed $item): array
    {
        return [
            'job_id' => $item->id()->toString(),
            'title' => $item->title(),
            'description' => $item->description(),
            'link' => $item->link(),
            'publication_date' => $item->publicationDate()->format('Y-m-d H:i:s'),
        ];
    }
}
