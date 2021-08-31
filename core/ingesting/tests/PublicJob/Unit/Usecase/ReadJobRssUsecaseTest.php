<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Unit\Usecase;

use Ingesting\PublicJob\Adapter\Rss\RssDataItem;
use Ingesting\PublicJob\Application\Model\Iso\RssReader;
use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Model\JobRepository;
use Ingesting\PublicJob\Application\Model\Service\JobUniqueService;
use Ingesting\PublicJob\Application\Usecase\ReadJobRssUsecase;
use Ingesting\SharedKernel\Model\PublicationDate;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\PublicJob\Application\Usecase\ReadErrataRssUsecase
 */
class ReadJobRssUsecaseTest extends TestCase
{
    private const ITEM_UUID = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const ITEM_TITLE = 'a title';

    private const ITEM_DESCRIPTION = 'a very long description, may be not';

    private const ITEM_LINK = 'https://www.google.it';

    private const ITEM_PUB_DATE = '2047-02-01 10:00:00';

    /**
     * @var JobRepository&MockObject
     */
    private $repository;

    /**
     * @var JobUniqueService&MockObject
     */
    private $jobUniqueService;

    /**
     * @var RssReader&MockObject
     */
    private $rssReader;

    private ReadJobRssUsecase $usecase;

    protected function setUp(): void
    {
        $this->repository = $this->getMockBuilder(JobRepository::class)->getMock();

        $this->jobUniqueService = $this->getMockBuilder(JobUniqueService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->rssReader = $this->getMockBuilder(RssReader::class)->getMock();

        $this->usecase = new ReadJobRssUsecase($this->rssReader, $this->jobUniqueService, $this->repository);
    }

    /**
     * @test
     */
    public function shouldAddANewErrataFeedItem(): void
    {
        $this->rssReader->expects(self::once())
            ->method('readRssFeed')
            ->willReturn($this->createRssData())
            ;

        $this->jobUniqueService->expects(self::once())
            ->method('isUnique')
            ->willReturn(true)
        ;

        $this->repository->expects(self::once())
            ->method('save')
            ->with(
                self::callback(
                    function (JobFeed $param): bool {
                        if (
                            $param->title() === self::ITEM_TITLE
                            && $param->description() === self::ITEM_DESCRIPTION
                            && $param->publicationDate()->sameValueAs(PublicationDate::fromString(self::ITEM_PUB_DATE))
                            && $param->link() === self::ITEM_LINK
                        ) {
                            return true;
                        }
                        return false;
                    }
                )
            );

        $this->usecase->readJobRssDataSource();
    }

    /**
     * @test
     */
    public function shouldAddMultipleErrataFeedItem(): void
    {
        $this->rssReader->expects(self::once())
            ->method('readRssFeed')
            ->willReturn($this->createRssDataWithFiveItem())
        ;

        $this->jobUniqueService->expects(self::exactly(5))
            ->method('isUnique')
            ->willReturn(true)
        ;

        $this->repository->expects(self::exactly(5))
            ->method('save')
            ->with(
                self::callback(
                    function (JobFeed $param): bool {
                        if (
                            $param->title() === self::ITEM_TITLE
                            && $param->description() === self::ITEM_DESCRIPTION
                            && $param->publicationDate()->sameValueAs(PublicationDate::fromString(self::ITEM_PUB_DATE))
                            && $param->link() === self::ITEM_LINK
                        ) {
                            return true;
                        }
                        return false;
                    }
                )
            );

        $this->usecase->readJobRssDataSource();
    }

    /**
     * @test
     */
    public function shouldNotPersistDuplicatedItem(): void
    {
        $this->rssReader->expects(self::once())
            ->method('readRssFeed')
            ->willReturn($this->createRssData())
        ;

        $this->expectException(\RuntimeException::class);

        $this->jobUniqueService->expects(self::once())
            ->method('isUnique')
            ->willReturn(false)
            ;

        $this->repository->expects(self::never())
            ->method('save')
            ->withAnyParameters()
            ;

        $this->usecase->readJobRssDataSource();
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
