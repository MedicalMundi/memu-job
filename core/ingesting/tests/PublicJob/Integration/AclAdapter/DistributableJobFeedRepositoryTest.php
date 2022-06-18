<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Integration\AclAdapter;

use Doctrine\ORM\EntityManager;
use Ingesting\PublicJob\AclAdapter\DistributableJobFeedRepository;
use Ingesting\PublicJob\Application\Model\JobFeed;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @covers \Ingesting\PublicJob\AclAdapter\DistributableJobFeedRepository
 */
class DistributableJobFeedRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager;

    private DistributableJobFeedRepository $distributableJobFeedRepository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        \assert($entityManager instanceof EntityManager);
        $this->entityManager = $entityManager;

        $this->distributableJobFeedRepository = new DistributableJobFeedRepository($this->entityManager);
    }

    public function testReturnEmptyWhenNoItemsInDB(): void
    {
        self::assertEmpty($this->distributableJobFeedRepository->getTodayData());
    }

    public function testReturnEmptyWhenNoItemsWithTodayDate(): void
    {
        \assert($this->entityManager instanceof EntityManager);
        $jobFeedRepository = $this->entityManager->getRepository(JobFeed::class);
        $jobFeedRepository->save($this->createItemWithYesterdayDate());

        self::assertEmpty($this->distributableJobFeedRepository->getTodayData());
    }

    public function testReturnItemWithTodayDate(): void
    {
        \assert($this->entityManager instanceof EntityManager);
        $jobFeedRepository = $this->entityManager->getRepository(JobFeed::class);
        $jobFeedRepository->save($this->createItemWithTodayDate());

        $data = $this->distributableJobFeedRepository->getTodayData();

        self::assertNotEmpty($data);
        self::assertCount(1, $data);
    }

    public function testReturnMultipleItemsWithTodayDate(): void
    {
        \assert($this->entityManager instanceof EntityManager);
        $jobFeedRepository = $this->entityManager->getRepository(JobFeed::class);
        $jobFeedRepository->save($this->createItemWithTodayDate());
        $jobFeedRepository->save($this->createItemWithTodayDate());

        $data = $this->distributableJobFeedRepository->getTodayData();

        self::assertNotEmpty($data);
        self::assertCount(2, $data);
    }

    private function createItemWithYesterdayDate(): JobFeed
    {
        return JobFeed::create("irrelevant", "irrelevant", "irrelevant", new \DateTimeImmutable('yesterday'));
    }

    private function createItemWithTodayDate(): JobFeed
    {
        return JobFeed::create("irrelevant", "irrelevant", "irrelevant", new \DateTimeImmutable('now'));
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
