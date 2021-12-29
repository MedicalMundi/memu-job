<?php declare(strict_types=1);

namespace Ingesting\Tests\Errata\Unit\Usecase;

use Ingesting\Errata\Adapter\Rss\RssDataItem;
use Ingesting\Errata\Application\Iso\RssReader;
use Ingesting\Errata\Application\Model\ErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeedAlreadyExist;
use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\Service\ErrataUniqueService;
use Ingesting\Errata\Application\Model\Service\UniqueErrataLinkService;
use Ingesting\Errata\Application\Model\Service\UniqueLink;
use Ingesting\Errata\Application\Usecase\ReadErrataRssUsecase;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\Errata\Application\Usecase\ReadErrataRssUsecase
 */
class ReadErrataRssUsecaseTest extends TestCase
{
    private const ITEM_UUID = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const ITEM_TITLE = 'a title';

    private const ITEM_DESCRIPTION = 'a very long description, may be not';

    private const ITEM_LINK = 'https://www.google.it';

    private const ITEM_PUB_DATE = '2047-02-01 10:00:00';

    /**
     * @var ErrataFeedRepository&MockObject
     */
    private $repository;

    /**
     * @var ErrataUniqueService&MockObject
     */
    private $errataUniqueService;

    /**
     * @var UniqueLink&MockObject
     */
    private $errataUniqueLinkService;

    /**
     * @var RssReader&MockObject
     */
    private $rssReader;

    private ReadErrataRssUsecase $usecase;

    protected function setUp(): void
    {
        $this->repository = $this->getMockBuilder(ErrataFeedRepository::class)->getMock();

        $this->errataUniqueService = $this->getMockBuilder(ErrataUniqueService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->errataUniqueLinkService = $this->getMockBuilder(UniqueErrataLinkService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->rssReader = $this->getMockBuilder(RssReader::class)->getMock();

        $this->usecase = new ReadErrataRssUsecase($this->repository, $this->errataUniqueService, $this->errataUniqueLinkService, $this->rssReader);
    }

    /**
     * @test
     */
    public function shouldAddANewErrataFeedItem(): void
    {
        $this->rssReader->expects(self::once())
            ->method('readRssFeed')
            ->willReturn($this->createRssData());

        $this->errataUniqueService->expects(self::once())
            ->method('isUnique')
            ->willReturn(true);

        $this->errataUniqueLinkService->expects(self::once())
            ->method('isUniqueLink')
            ->willReturn(true);

        $this->repository->expects(self::once())
            ->method('save')
            ->with(
                self::callback(
                    function (ErrataFeed $param): bool {
                        if (
                            $param->title() === self::ITEM_TITLE
                            && $param->description() === self::ITEM_DESCRIPTION
                            //&& $param->publicationDate()->sameValueAs(PublicationDate::fromString(self::ITEM_PUB_DATE))
                            && $param->link() === self::ITEM_LINK
                        ) {
                            return true;
                        }
                        return false;
                    }
                )
            );

        $this->usecase->readErrataRssDataSource();
    }

    /**
     * @test
     */
    public function shouldAddMultipleErrataFeedItem(): void
    {
        $this->rssReader->expects(self::once())
            ->method('readRssFeed')
            ->willReturn($this->createRssDataWithFiveItem());

        $this->errataUniqueLinkService->expects(self::exactly(5))
            ->method('isUniqueLink')
            ->willReturn(true);

        $this->errataUniqueService->expects(self::exactly(5))
            ->method('isUnique')
            ->willReturn(true);

        $this->repository->expects(self::exactly(5))
            ->method('save')
            ->with(
                self::callback(
                    function (ErrataFeed $param): bool {
                        if (
                            $param->title() === self::ITEM_TITLE
                            && $param->description() === self::ITEM_DESCRIPTION
                            //&& $param->publicationDate()->sameValueAs(PublicationDate::fromString(self::ITEM_PUB_DATE))
                            && $param->link() === self::ITEM_LINK
                        ) {
                            return true;
                        }
                        return false;
                    }
                )
            );

        $this->usecase->readErrataRssDataSource();
    }

    /**
     * @test
     */
    public function shouldNotPersistDuplicatedItem(): void
    {
        $this->expectException(ErrataFeedAlreadyExist::class);

        $this->rssReader->expects(self::once())
            ->method('readRssFeed')
            ->willReturn($this->createRssData());

        $this->errataUniqueLinkService->expects(self::once())
            ->method('isUniqueLink')
            ->willReturn(true);

        $this->errataUniqueService->expects(self::once())
            ->method('isUnique')
            ->willReturn(false);

        $this->repository->expects(self::never())
            ->method('save')
            ->withAnyParameters();

        $this->usecase->readErrataRssDataSource();
    }

    /**
     * @test
     */
    public function shouldIgnoreFeedWithSameLink(): void
    {
        $this->rssReader->expects(self::once())
            ->method('readRssFeed')
            ->willReturn($this->createRssData());

        $this->errataUniqueLinkService->expects(self::once())
            ->method('isUniqueLink')
            ->willReturn(false);

        $this->errataUniqueService->expects(self::never())
            ->method('isUnique');

        $this->repository->expects(self::never())
            ->method('save')
            ->withAnyParameters();

        $this->usecase->readErrataRssDataSource();
    }

    private function createRssData(): array
    {
        return [
            RssDataItem::create(self::ITEM_TITLE, self::ITEM_DESCRIPTION, self::ITEM_LINK, self::ITEM_PUB_DATE),
        ];
    }

    private function createRssDataWithFiveItem(): array
    {
        return [
            RssDataItem::create(self::ITEM_TITLE, self::ITEM_DESCRIPTION, self::ITEM_LINK, self::ITEM_PUB_DATE),
            RssDataItem::create(self::ITEM_TITLE, self::ITEM_DESCRIPTION, self::ITEM_LINK, self::ITEM_PUB_DATE),
            RssDataItem::create(self::ITEM_TITLE, self::ITEM_DESCRIPTION, self::ITEM_LINK, self::ITEM_PUB_DATE),
            RssDataItem::create(self::ITEM_TITLE, self::ITEM_DESCRIPTION, self::ITEM_LINK, self::ITEM_PUB_DATE),
            RssDataItem::create(self::ITEM_TITLE, self::ITEM_DESCRIPTION, self::ITEM_LINK, self::ITEM_PUB_DATE),
        ];
    }
}
