<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Unit\Model\Service;

use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Model\JobId;
use Ingesting\PublicJob\Application\Model\JobRepository;
use Ingesting\PublicJob\Application\Model\Service\JobUniqueService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\PublicJob\Application\Model\Service\JobUniqueService
 */
class JobUniqueServiceTest extends TestCase
{
    /**
     * @var JobRepository & MockObject
     */
    private $repository;

    private JobUniqueService $jobUniqueService;

    protected function setUp(): void
    {
        $this->repository = $this->getMockBuilder(JobRepository::class)->getMock();

        $this->jobUniqueService = new JobUniqueService($this->repository);
    }

    /**
     * @test
     */
    public function shouldDetectDuplicateIdentity(): void
    {
        $jobId = JobId::fromString($uuid = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0');

        $this->repository->expects(self::once())
            ->method('withId')
            ->willReturn($this->createErrataFeedItem($jobId))
        ;

        $result = $this->jobUniqueService->isUnique($jobId);

        self::assertFalse($result);
    }

    /**
     * @test
     */
    public function shouldNotDetectDuplicateIdentity(): void
    {
        $jobId = JobId::fromString($uuid = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0');

        $this->repository->expects(self::once())
            ->method('withId')
        ;

        $result = $this->jobUniqueService->isUnique($jobId);

        self::assertFalse($result);
    }

    private function createErrataFeedItem(?JobId $id): JobFeed
    {
        return JobFeed::create('a title', 'a description', 'https://www.google.com', '2047-02-01 10:00:00', $id);
    }
}
