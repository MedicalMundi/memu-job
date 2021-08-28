<?php declare(strict_types=1);

namespace Ingesting\SharedKernel\Model;

class PublicationDate
{
    /**
     * @var \DateTimeImmutable
     */
    private $publicationDate;

    public static function fromString(string $publicationDate): PublicationDate
    {
        return new self($publicationDate);
    }

    private function __construct(string $publicationDate)
    {
        $this->publicationDate = new \DateTimeImmutable($publicationDate, new \DateTimeZone('UTC'));
    }

    public function toString(): string
    {
        return $this->publicationDate->format(\DateTime::ATOM);
    }

    public function sameValueAs(PublicationDate $object): bool
    {
        return $this->publicationDate->format('U.u') === $object->publicationDate->format('U.u');
    }
}
