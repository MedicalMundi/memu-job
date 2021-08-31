<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model;

use RuntimeException;

final class CouldNotPersistJobFeed extends RuntimeException
{
    public static function withId(JobId $jobId): self
    {
        return new self(
            sprintf(
                'Could not persist job feed item with id %s',
                $jobId->toString()
            )
        );
    }
}
