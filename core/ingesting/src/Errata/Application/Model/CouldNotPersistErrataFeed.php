<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model;

use RuntimeException;

final class CouldNotPersistErrataFeed extends RuntimeException
{
    public static function withId(ErrataId $errataId): self
    {
        return new CouldNotPersistErrataFeed(
            \sprintf(
                'Could not persist  errata feed item with id %s',
                $errataId->toString()
            )
        );
    }
}
