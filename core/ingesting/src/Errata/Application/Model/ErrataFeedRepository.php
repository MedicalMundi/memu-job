<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model;

interface ErrataFeedRepository
{
    /**
     * @throws \Ingesting\Errata\Application\Model\CouldNotPersistErrataFeed
     */
    public function save(ErrataFeed $errata): void;

    /**
     * @throws \Ingesting\Errata\Application\Model\CouldNotFindErrataFeed
     */
    public function withId(ErrataId $errataId): ErrataFeed;
}
