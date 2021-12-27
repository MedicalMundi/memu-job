<?php declare(strict_types=1);

namespace Ingesting\Tests\Errata\Unit\Model;

use Ingesting\Errata\Application\Model\ErrataFeed;
use Ingesting\Errata\Application\Model\ErrataId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\Errata\Application\Model\ErrataFeed
 */
class ErrataFeedTest extends TestCase
{
    private const UUID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const A_FEED_TITLE = 'a feed title';

    private const A_FEED_DESCRIPTION = 'a feed description';

    private const A_FEED_LINK = 'https://www.pincopallino.com';

    private const A_FEED_PUBLICATION_DATE = '2047-02-01 10:00:00';

    /**
     * @test
     */
    public function shouldBeCreatedWithIdentityParameters(): void
    {
        $id = ErrataId::generate();
        $title = self::A_FEED_TITLE;
        $description = self::A_FEED_DESCRIPTION;
        $link = self::A_FEED_LINK;
        $publicationDate = new \DateTimeImmutable(self::A_FEED_PUBLICATION_DATE);

        $errata = ErrataFeed::create($title, $description, $link, $publicationDate, $id);

        self::assertNotEmpty($errata->id()->toString());
    }

    /**
     * @test
     */
    public function shouldBeCreatedWithoutIdentityParameters(): void
    {
        $title = self::A_FEED_TITLE;
        $description = self::A_FEED_DESCRIPTION;
        $link = self::A_FEED_LINK;
        $publicationDate = new \DateTimeImmutable(self::A_FEED_PUBLICATION_DATE);

        $errata = ErrataFeed::create($title, $description, $link, $publicationDate);

        self::assertNotEmpty($errata->id()->toString());
    }

    /**
     * @test
     */
    public function shouldExposeTheInternalState(): void
    {
        $id = ErrataId::fromString(self::UUID);
        $title = self::A_FEED_TITLE;
        $description = self::A_FEED_DESCRIPTION;
        $link = self::A_FEED_LINK;
        $publicationDate = new \DateTimeImmutable(self::A_FEED_PUBLICATION_DATE);

        $errata = ErrataFeed::create($title, $description, $link, $publicationDate, $id);

        self::assertSame($id, $errata->id());
        self::assertSame($title, $errata->title());
        self::assertSame($description, $errata->description());
        self::assertSame($link, $errata->link());
        self::assertSame($publicationDate, $errata->publicationDate());
    }
}
