<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Domain\Model;

use RuntimeException;

final class CouldNotPersistErrataFeed extends RuntimeException
{
    public static function withId(ErrataId $errataId): self
    {
        return new self(
            sprintf(
                'Could not persist  errata feed item with id %s',
                $errataId->toString()
            )
        );
    }
}
