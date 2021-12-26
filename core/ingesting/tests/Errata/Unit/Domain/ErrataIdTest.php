<?php declare(strict_types=1);

namespace Ingesting\Tests\Errata\Unit\Domain;

use Ingesting\Errata\Application\Model\ErrataId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Exception\InvalidUuidStringException;

/**
 * @covers \Ingesting\Errata\Application\Model\ErrataId
 */
class ErrataIdTest extends TestCase
{
    private const FIRST_ID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const SECOND_ID = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const COPY_OF_FIRST_ID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    /**
     * @test
     */
    public function it_can_auto_generate_ErrataId(): void
    {
        $ErrataId = ErrataId::generate();

        self::assertNotEmpty($ErrataId->toString());
    }

    /**
     * @test
     */
    public function it_creates_ErrataId_from_string(): void
    {
        $ErrataId = ErrataId::fromString(self::FIRST_ID);
        self::assertSame(self::FIRST_ID, $ErrataId->toString());
        self::assertSame(self::FIRST_ID, $ErrataId->__toString());
    }

    /**
     * @test
     * @depends it_creates_ErrataId_from_string
     */
    public function it_can_be_compared(): void
    {
        $first = ErrataId::fromString(self::FIRST_ID);
        $second = ErrataId::fromString(self::SECOND_ID);
        $third = ErrataId::fromString(self::COPY_OF_FIRST_ID);

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($third));
        self::assertFalse($second->equals($third));
    }

    /**
     * @test
     */
    public function empty_uuid_string_should_fail(): void
    {
        self::expectException(InvalidUuidStringException::class);

        ErrataId::fromString('');
    }
}
