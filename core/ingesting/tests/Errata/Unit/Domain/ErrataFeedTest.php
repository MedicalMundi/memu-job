<?php declare(strict_types=1);

namespace Ingesting\Tests\Errata\Unit\Domain;

use Ingesting\Errata\Application\Domain\Model\ErrataFeed;
use Ingesting\Errata\Application\Domain\Model\ErrataId;
use Ingesting\SharedKernel\Model\PublicationDate;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\Errata\Application\Domain\Model\ErrataFeed
 */
class ErrataFeedTest extends TestCase
{
    private const UUID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    /**
     * @test
     */
    public function shouldBeCreatedWithIdentityParameters(): void
    {
        $id = ErrataId::generate();
        $title = 'a feed title';
        $description = 'a feed description';
        $link = 'https://www.pincopallino.com';
        $publicationDate = '2047-02-01 10:00:00';

        $errata = ErrataFeed::create($title, $description, $link, $publicationDate, $id);

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

        $errata = ErrataFeed::create($title, $description, $link, $publicationDate);

        self::assertNotEmpty($errata->id()->toString());
    }

    /**
     * @test
     */
    public function shouldExposeTheInternalState(): void
    {
        $id = ErrataId::fromString(self::UUID);
        $title = 'a feed title';
        $description = 'a feed description';
        $link = 'https://www.pincopallino.com';
        $publicationDate = '2047-02-01 10:00:00';

        $errata = ErrataFeed::create($title, $description, $link, $publicationDate, $id);

        self::assertSame($id, $errata->id());
        self::assertSame($title, $errata->title());
        self::assertSame($description, $errata->description());
        self::assertSame($link, $errata->link());
        self::assertSame(PublicationDate::fromString($publicationDate)->toString(), $errata->publicationDate()->toString());
    }
}
