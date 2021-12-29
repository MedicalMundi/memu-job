<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model;

use RuntimeException;

final class ErrataFeedAlreadyExist extends RuntimeException
{
    public static function withId(ErrataId $errataId): self
    {
        return new self(
            sprintf(
                'Errata feed item with id %s already exist',
                $errataId->toString()
            )
        );
    }
}
