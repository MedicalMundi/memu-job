<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model;

interface ErrataFeedRepository
{
    /**
     * @throws \Ingesting\Errata\Application\Model\CouldNotPersistErrataFeed
     */
    public function save(\Ingesting\Errata\Application\Model\ErrataFeed $errata): void;

    /**
     * @throws \Ingesting\Errata\Application\Model\CouldNotFindErrataFeed
     */
    public function withId(\Ingesting\Errata\Application\Model\ErrataId $errataId): \Ingesting\Errata\Application\Model\ErrataFeed;
}
