<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Unit\Model;

use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Model\JobId;
use Ingesting\SharedKernel\Model\PublicationDate;
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
        $publicationDate = '2047-02-01 10:00:00';

        $errata = JobFeed::create($title, $description, $link, $publicationDate, $id);

        self::assertNotEmpty($errata->id()->toString());
    }

    /**
     * @test
     */
    public function shouldBeCreatedWithoutIdentityParameters(): void
    {
        $title = 'a feed title';
        $description = 'a feed description';
        $link = 'https://www.pincopallino.com';
        $publicationDate = '2047-02-01 10:00:00';

        $errata = JobFeed::create($title, $description, $link, $publicationDate);

        self::assertNotEmpty($errata->id()->toString());
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
        $publicationDate = '2047-02-01 10:00:00';

        $errata = JobFeed::create($title, $description, $link, $publicationDate, $id);

        self::assertSame($id, $errata->id());
        self::assertSame($title, $errata->title());
        self::assertSame($description, $errata->description());
        self::assertSame($link, $errata->link());
        self::assertSame(PublicationDate::fromString($publicationDate)->toString(), $errata->publicationDate()->toString());
    }
}
