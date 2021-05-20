<?php

declare(strict_types=1);

namespace Ingesting\Errata\Application\Domain\Model;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * null
 * @codeCoverageIgnore
 */
final class ErrataId
{
    private UuidInterface $uuid;

    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $uuid): self
    {
        return new self(Uuid::fromString($uuid));
    }

    public static function fromBinary(string $bytes): self
    {
        return new self(Uuid::fromBytes($bytes));
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function toBinary(): string
    {
        return $this->uuid->getBytes();
    }

    public function equals(?self $other): bool
    {
        return null !== $other && $this->uuid->equals($other->uuid);
    }
}
