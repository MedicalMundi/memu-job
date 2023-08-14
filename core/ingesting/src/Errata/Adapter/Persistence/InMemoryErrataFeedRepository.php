<?php declare(strict_types=1);

namespace Ingesting\Errata\Adapter\Persistence;

use Ingesting\Errata\Application\Model\CouldNotFindErrataFeed;
use Ingesting\Errata\Application\Model\CouldNotPersistErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeedAlreadyExist;
use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\ErrataId;

class InMemoryErrataFeedRepository implements ErrataFeedRepository
{
    private array $items = [];

    /**
     * @throws CouldNotPersistErrataFeed
     * @throws ErrataFeedAlreadyExist
     */
    public function save(ErrataFeed $errata): void
    {
        if (\array_key_exists($errata->id()->toString(), $this->items)) {
            throw ErrataFeedAlreadyExist::withId($errata->id());
        }

        try {
            $this->items[$errata->id()->toString()] = $errata;
        } catch (\Exception) {
            throw CouldNotPersistErrataFeed::withId($errata->id());
        }
    }

    /**
     * @throws CouldNotFindErrataFeed
     */
    public function withId(ErrataId $errataId): ErrataFeed
    {
        if (! \array_key_exists($errataId->toString(), $this->items)) {
            throw CouldNotFindErrataFeed::withId($errataId);
        }

        return $this->items[$errataId->toString()];
    }

    public function isUniqueIdentity(ErrataId $errataId): bool
    {
        $result = false;
        if (! \array_key_exists($errataId->toString(), $this->items)) {
            $result = true;
        }

        return $result;
    }

    public function isUniqueLink(string $errataLink): bool
    {
        if (0 === \count($this->items)) {
            return true;
        }

        $result = true;
        /** @var ErrataFeed $errataFeed */
        foreach ($this->items as $errataFeed) {
            if ($errataLink === $errataFeed->link()) {
                $result = false;
            }
        }

        return $result;
    }
}
