<?php declare(strict_types=1);

namespace Publishing\Cms\Application\Model\ConcorsoArticle;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ConcorsoArticleId implements \Stringable
{
    public static function generate(): ConcorsoArticleId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $id): ConcorsoArticleId
    {
        return new self(Uuid::fromString($id));
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

    public function equals(ConcorsoArticleId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
