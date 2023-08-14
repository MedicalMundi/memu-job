<?php declare(strict_types=1);

namespace Ingesting\Errata\Adapter\Persistence\Doctrine\Config;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Ingesting\Errata\Application\Model\ErrataId;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\UuidInterface;

class ErrataIdType extends UuidType
{
    public const NAME = 'errata_id';

    /**
     * @param UuidInterface|string|null $value
     *
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?ErrataId
    {
        if ('' === $value) {
            return null;
        }
        if ($value instanceof ErrataId) {
            return $value;
        }
        try {
            return ErrataId::fromString((string) $value);
        } catch (\Exception) {
            throw ConversionException::conversionFailed((string) $value, self::NAME);
        }
    }

    /**
     * @param UuidInterface|string|null $value
     *
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }
        if ($value instanceof ErrataId) {
            return $value->toString();
        }
        throw ConversionException::conversionFailed((string) $value, self::NAME);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
