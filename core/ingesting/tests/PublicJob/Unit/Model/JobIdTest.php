<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Unit\Model;

use Ingesting\PublicJob\Application\Model\JobId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Exception\InvalidUuidStringException;

/**
 * @covers \Ingesting\PublicJob\Application\Model\JobId
 */
class JobIdTest extends TestCase
{
    private const FIRST_ID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const SECOND_ID = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const COPY_OF_FIRST_ID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    /**
     * @test
     */
    public function it_can_auto_generate_ErrataId(): void
    {
        $jobId = JobId::generate();

        self::assertNotEmpty($jobId->toString());
    }

    /**
     * @test
     */
    public function it_creates_JobId_from_string(): void
    {
        $jobId = JobId::fromString(self::FIRST_ID);
        self::assertSame(self::FIRST_ID, $jobId->toString());
        self::assertSame(self::FIRST_ID, $jobId->__toString());
    }

    /**
     * @test
     * @depends it_creates_JobId_from_string
     */
    public function it_can_be_compared(): void
    {
        $first = JobId::fromString(self::FIRST_ID);
        $second = JobId::fromString(self::SECOND_ID);
        $third = JobId::fromString(self::COPY_OF_FIRST_ID);

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

        JobId::fromString('');
    }
}
