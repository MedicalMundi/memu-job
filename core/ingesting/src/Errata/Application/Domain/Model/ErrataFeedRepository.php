<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Domain\Model;

interface ErrataFeedRepository
{
    /**
     * @throws CouldNotPersistErrataFeed
     */
    public function save(ErrataFeed $errata): void;

    /**
     * @throws CouldNotFindErrataFeed
     */
    public function withId(ErrataId $errataId): ErrataFeed;
}
