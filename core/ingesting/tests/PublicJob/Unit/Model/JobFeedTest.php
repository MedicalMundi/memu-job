<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Unit\Model;

use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Model\JobId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\PublicJob\Application\Model\JobFeed
 */
class JobFeedTest extends TestCase
{
    private const UUID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    /**
     * @test
     */
    public function shouldBeCreatedWithIdentityParameters(): void
    {
        $id = JobId::generate();
        $title = 'a feed title';
        $description = 'a feed description';
        $link = 'https://www.pincopallino.com';
        $publicationDate = new \DateTimeImmutable('2047-02-01 10:00:00');

        $jobFeed = JobFeed::create($title, $description, $link, $publicationDate, $id);

        self::assertNotEmpty($jobFeed->id()->toString());
    }

    /**
     * @test
     */
    public function shouldBeCreatedWithoutIdentityParameters(): void
    {
        $title = 'a feed title';
        $description = 'a feed description';
        $link = 'https://www.pincopallino.com';
        $publicationDate = new \DateTimeImmutable('2047-02-01 10:00:00');

        $jobFeed = JobFeed::create($title, $description, $link, $publicationDate);

        self::assertNotEmpty($jobFeed->id()->toString());
    }

    /**
     * @test
     */
    public function shouldExposeTheInternalState(): void
    {
        $id = JobId::fromString(self::UUID);
        $title = 'a feed title';
        $description = 'a feed description';
        $link = 'https://www.pincopallino.com';
        $publicationDate = new \DateTimeImmutable('2047-02-01 10:00:00');

        $jobFeed = JobFeed::create($title, $description, $link, $publicationDate, $id);

        self::assertSame($id, $jobFeed->id());
        self::assertSame($title, $jobFeed->title());
        self::assertSame($description, $jobFeed->description());
        self::assertSame($link, $jobFeed->link());
        self::assertSame($publicationDate, $jobFeed->publicationDate());
    }
}
