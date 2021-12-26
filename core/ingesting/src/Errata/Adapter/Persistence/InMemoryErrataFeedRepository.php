<?php declare(strict_types=1);

namespace Ingesting\Errata\Adapter\Persistence;

use Ingesting\Errata\Application\Model\CouldNotFindErrataFeed;
use Ingesting\Errata\Application\Model\CouldNotPersistErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\ErrataId;

class InMemoryErrataFeedRepository implements ErrataFeedRepository
{
    private array $items = [];

    /**
     * @throws CouldNotPersistErrataFeed
     */
    public function save(ErrataFeed $errata): void
    {
        try {
            $this->items[$errata->id()->toString()] = $errata;
        } catch (\Exception $e) {
            throw CouldNotPersistErrataFeed::withId($errata->id());
        }
    }

    /**
     * @throws CouldNotFindErrataFeed
     */
    public function withId(ErrataId $errataId): ErrataFeed
    {
        if (\array_key_exists($errataId->toString(), $this->items)) {
            throw CouldNotFindErrataFeed::withId($errataId);
        }

        return $this->items[$errataId->toString()];
    }
}
