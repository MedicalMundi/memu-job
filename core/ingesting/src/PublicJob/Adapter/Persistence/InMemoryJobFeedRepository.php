<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Adapter\Persistence;

use Ingesting\PublicJob\Application\Model\CouldNotFindJobFeed;
use Ingesting\PublicJob\Application\Model\CouldNotPersistJobFeed;
use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Model\JobFeedAlreadyExist;
use Ingesting\PublicJob\Application\Model\JobId;
use Ingesting\PublicJob\Application\Model\JobRepository;

class InMemoryJobFeedRepository implements JobRepository
{
    private array $items = [];

    public function save(JobFeed $job): void
    {
        if (\array_key_exists($job->id()->toString(), $this->items)) {
            throw JobFeedAlreadyExist::withId($job->id());
        }

        try {
            $this->items[$job->id()->toString()] = $job;
        } catch (\Exception $e) {
            throw CouldNotPersistJobFeed::withId($job->id());
        }
    }

    public function withId(JobId $jobId): JobFeed
    {
        if (! \array_key_exists($jobId->toString(), $this->items)) {
            throw CouldNotFindJobFeed::withId($jobId);
        }

        return $this->items[$jobId->toString()];
    }

    public function isUniqueIdentity(JobId $jobId): bool
    {
        $result = false;
        if (\array_key_exists($jobId->toString(), $this->items)) {
            $result = true;
        }

        return $result;
    }

    public function isUniqueLink(string $jobLink): bool
    {
        if (0 === \count($this->items)) {
            return true;
        }

        $result = true;
        foreach ($this->items as $jobFeed) {
            if ($jobLink === $jobFeed->link()) {
                $result = false;
            }
        }

        return $result;
    }
}
