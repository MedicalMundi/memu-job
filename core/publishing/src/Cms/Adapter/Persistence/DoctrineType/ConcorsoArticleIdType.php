<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\Persistence\DoctrineType;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Publishing\Cms\Application\Model\ConcorsoArticle\ConcorsoArticleId;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\UuidInterface;

class ConcorsoArticleIdType extends UuidType
{
    public const NAME = 'concorso_article_id';

    /**
     * @param UuidInterface|string|null $value
     *
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?ConcorsoArticleId
    {
        if ('' === $value) {
            return null;
        }
        if ($value instanceof ConcorsoArticleId) {
            return $value;
        }
        try {
            return ConcorsoArticleId::fromString((string) $value);
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
        if ($value instanceof ConcorsoArticleId) {
            return $value->toString();
        }
        throw ConversionException::conversionFailed((string) $value, self::NAME);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
