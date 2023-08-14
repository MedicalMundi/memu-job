<?php declare(strict_types=1);

namespace Ingesting\Errata\Application\Model;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ErrataId implements \Stringable
{
    public static function generate(): self
    {
        return new ErrataId(Uuid::uuid4());
    }

    public static function fromString(string $id): self
    {
        return new ErrataId(Uuid::fromString($id));
    }

    private function __construct(
        private UuidInterface $uuid
    ) {
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function equals(self $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
