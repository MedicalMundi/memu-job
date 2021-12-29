<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model;

use RuntimeException;

final class CouldNotFindErrataFeed extends RuntimeException
{
    public static function withId(ErrataId $errataId): self
    {
        return new CouldNotFindErrataFeed(
            sprintf(
                'Could not find a errata feed item with id %s',
                $errataId->toString()
            )
        );
    }
}
