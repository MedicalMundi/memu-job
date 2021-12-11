<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model;

use RuntimeException;

final class JobFeedAlreadyExist extends RuntimeException
{
    public static function withId(JobId $jobId): self
    {
        return new self(
            sprintf(
                'Job feed item with id %s already exist',
                $jobId->toString()
            )
        );
    }
}
