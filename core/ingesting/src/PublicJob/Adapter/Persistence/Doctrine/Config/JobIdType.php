<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Adapter\Persistence\Doctrine\Config;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Ingesting\PublicJob\Application\Model\JobId;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\UuidInterface;

class JobIdType extends UuidType
{
    public const NAME = 'job_id';

    /**
     * @param UuidInterface|string|null $value
     *
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?JobId
    {
        if ('' === $value) {
            return null;
        }
        if ($value instanceof JobId) {
            return $value;
        }
        try {
            return JobId::fromString((string) $value);
        } catch (\Exception $ex) {
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
        if ($value instanceof JobId) {
            return $value->toString();
        }
        throw ConversionException::conversionFailed((string) $value, self::NAME);
    }

    public function getName()
    {
        return self::NAME;
    }
}
