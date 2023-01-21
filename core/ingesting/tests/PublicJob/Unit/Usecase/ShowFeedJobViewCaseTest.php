<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Unit\Usecase;

use Ingesting\PublicJob\Application\Usecase\ReadableJobFeedRepository;
use Ingesting\PublicJob\Application\Usecase\ShowFeed\ShowFeedJobViewCase;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\PublicJob\Application\Usecase\ShowFeed\ShowFeedJobViewCase
 */
class ShowFeedJobViewCaseTest extends TestCase
{
    private const UUID = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const TITLE = 'Feed irrelevant title';

    private const DESCRIPTION = 'Feed irrelevant description';

    private const LINK = 'https://www.gazzettaufficiale.it';

    private const PUB_DATE = 'Thu, 25 Apr 2019 20:00:00 GMT';

    /**
     * @var MockObject
     */
    private $repository;

    private ShowFeedJobViewCase $viewcase;

    protected function setUp(): void
    {
        $this->repository = $this->getMockBuilder(ReadableJobFeedRepository::class)->getMock();

        $this->viewcase = new ShowFeedJobViewCase($this->repository);
    }

    /**
     * @test
     */
    public function shouldShowAnEmptyListOfJobFeed(): void
    {
        $expectedEmptyResult = [];

        $this->repository->expects(self::once())
            ->method('listAvailableJobFeed')
            ->willReturn([])
        ;

        $result = $this->viewcase->showFeedJob();

        self::assertSame($expectedEmptyResult, $result);
    }

    /**
     * @test
     */
    public function shouldShowAListOfJobFeedWithOneItem(): void
    {
        $repositoryData = [
            [
                'job_id' => self::UUID,
                'title' => self::TITLE,
                'description' => self::DESCRIPTION,
                'link' => self::LINK,
                'publication_date' => '2019-04-25 20:00:00',
            ],
        ];

        $expectedResult = $repositoryData;

        $this->repository->expects(self::once())
            ->method('listAvailableJobFeed')
            ->willReturn($repositoryData)
        ;

        $result = $this->viewcase->showFeedJob();

        self::assertSame($expectedResult, $result);
    }
}
