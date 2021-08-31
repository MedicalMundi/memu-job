<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model;

use RuntimeException;

final class CouldNotFindJobFeed extends RuntimeException
{
    public static function withId(JobId $jobId): self
    {
        return new self(
            sprintf(
                'Could not find a job feed item with id %s',
                $jobId->toString()
            )
        );
    }
}
