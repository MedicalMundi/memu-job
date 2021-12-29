<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model;

interface ErrataFeedRepository
{
    /**
     * @throws CouldNotPersistErrataFeed
     * @throws ErrataFeedAlreadyExist
     */
    public function save(ErrataFeed $errata): void;

    /**
     * @throws CouldNotFindErrataFeed
     */
    public function withId(ErrataId $errataId): ErrataFeed;

    public function isUniqueIdentity(ErrataId $errataId): bool;

    public function isUniqueLink(string $errataLink): bool;
}
