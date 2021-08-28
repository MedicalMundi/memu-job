<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Domain\Model;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ErrataId
{
    private UuidInterface $uuid;

    public static function generate(): ErrataId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $id): ErrataId
    {
        return new self(Uuid::fromString($id));
    }

    private function __construct(UuidInterface $id)
    {
        $this->uuid = $id;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function equals(ErrataId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
