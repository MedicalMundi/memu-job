<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Usecase\ShowFeed;

use Ingesting\PublicJob\Application\Usecase\ReadableJobFeedRepository;

class ShowFeedJobViewCase implements ShowAllFeedJob
{
    public function __construct(
        private ReadableJobFeedRepository $repository
    ) {
    }

    public function showFeedJob(): array
    {
        return $this->repository->listAvailableJobFeed();
    }
}
