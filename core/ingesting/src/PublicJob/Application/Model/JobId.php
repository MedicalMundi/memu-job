<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Application\Model;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class JobId
{
    private UuidInterface $uuid;

    public static function generate(): JobId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $id): JobId
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

    public function equals(JobId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
