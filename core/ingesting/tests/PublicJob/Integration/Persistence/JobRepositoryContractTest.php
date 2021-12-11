<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\Persistence;

use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Model\JobFeedAlreadyExist;
use Ingesting\PublicJob\Application\Model\JobId;
use Ingesting\PublicJob\Application\Model\JobRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class JobRepositoryContractTest extends KernelTestCase
{
    private const TITLE = 'Feed irrelevant title';

    private const DESCRIPTION = 'Feed irrelevant description';

    private const LINK = 'https://www.gazzettaufficiale.it';

    private const PUB_DATE = 'Thu, 25 Apr 2019 20:00:00 GMT';

    /**
     * @var JobRepository
     */
    private $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createRepository();
    }

    abstract protected function createRepository(): JobRepository;

    /**
     * @test
     */
    public function it_can_persist_data(): void
    {
        $identity = JobId::generate();
        $jobFeed = $this->createJobFeed($identity);
        $this->repository->save($jobFeed);

        $persistedItem = $this->verifyItemById($identity);
        self::assertEquals(self::TITLE, $persistedItem->title());
        self::assertEquals(self::DESCRIPTION, $persistedItem->description());
        self::assertEquals(self::LINK, $persistedItem->link());
        //TODO
        //self::assertEquals(self::PUB_DATE, $savedItem->publicationDate());
    }

    /**
     * @test
     */
    public function duplicate_identity_should_throw_exception(): void
    {
        $this->expectException(JobFeedAlreadyExist::class);

        $identity = JobId::generate();
        $jobFeed = $this->createJobFeed($identity);
        $this->repository->save($jobFeed);

        $this->repository->save($jobFeed);
    }

    protected function createJobFeed(JobId $id): JobFeed
    {
        $data = JobFeed::create(
            self::TITLE,
            self::DESCRIPTION,
            self::LINK,
            self::PUB_DATE,
            $id,
        );

        return $data;
    }

    protected function verifyItemById(JobId $id): JobFeed
    {
        return $this->repository->withId($id);
    }
}
