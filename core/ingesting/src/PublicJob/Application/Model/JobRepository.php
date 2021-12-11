<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model;

use Ingesting\PublicJob\Application\Model\Iso\ApplicationPort;

interface JobRepository extends ApplicationPort
{
    /**
     * @throws CouldNotPersistJobFeed
     * @throws JobFeedAlreadyExist
     */
    public function save(JobFeed $job): void;

    /**
     * @throws CouldNotFindJobFeed
     */
    public function withId(JobId $jobId): JobFeed;
}
