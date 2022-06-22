<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\Persistence\ReadableJobRepository;

use DateTimeImmutable;
use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Model\JobId;
use Ingesting\PublicJob\Application\Usecase\ReadableJobFeedRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class ReadableJobRepositoryContractTest extends KernelTestCase
{
    private const UUID = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const TITLE = 'Feed irrelevant title';

    private const DESCRIPTION = 'Feed irrelevant description';

    private const LINK = 'https://www.gazzettaufficiale.it';

    private const PUB_DATE = 'Thu, 25 Apr 2019 20:00:00 GMT';

    protected ReadableJobFeedRepository $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createRepository();
    }

    abstract protected function createRepository(): ReadableJobFeedRepository;

    /**
     * @test
     */
    public function it_can_retrieve_a_single_data_item(): void
    {
        $identity = JobId::generate();
        $jobFeed = $this->createJobFeed($identity);
        $this->loadFixtures([$jobFeed]);

        $result = $this->repository->listAvailableJobFeed();

        self::assertCount(1, $result);
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_multiple_data_item(): void
    {
        $jobFeedOne = $this->createJobFeed(JobId::generate());
        $jobFeedTwo = $this->createJobFeed(JobId::generate());
        $jobFeedThree = $this->createJobFeed(JobId::generate());
        $this->loadFixtures([
            $jobFeedOne,
            $jobFeedTwo,
            $jobFeedThree,
        ]);

        $result = $this->repository->listAvailableJobFeed();

        self::assertCount(3, $result);
    }

    /**
     * @test
     */
    public function it_can_return_the_correct_array_item_format(): void
    {
        $expectedResult = [
            [
                'job_id' => self::UUID,
                'title' => self::TITLE,
                'description' => self::DESCRIPTION,
                'link' => self::LINK,
                'publication_date' => '2019-04-25 20:00:00',
            ],
        ];
        $identity = JobId::fromString(self::UUID);
        $jobFeed = $this->createJobFeed($identity);
        $this->loadFixtures([$jobFeed]);

        $result = $this->repository->listAvailableJobFeed();

        self::assertEquals($expectedResult, $result);
    }

    protected function loadFixtures(array $fixtures): void
    {
    }

    protected function createJobFeed(JobId $id): JobFeed
    {
        $data = JobFeed::create(
            self::TITLE,
            self::DESCRIPTION,
            self::LINK,
            new DateTimeImmutable(self::PUB_DATE),
            $id,
        );

        return $data;
    }
}
