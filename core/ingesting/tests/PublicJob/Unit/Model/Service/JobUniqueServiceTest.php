<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Unit\Model\Service;

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
    private const UUID = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';

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
    public function shouldDetectAUniqueIdentity(): void
    {
        $jobId = JobId::fromString(self::UUID);

        $this->repository->expects(self::once())
            ->method('isUniqueIdentity')
            ->willReturn(true)
        ;

        $result = $this->jobUniqueService->isUnique($jobId);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function shouldNotDetectDuplicateIdentity(): void
    {
        $jobId = JobId::fromString(self::UUID);

        $this->repository->expects(self::once())
            ->method('isUniqueIdentity')
            ->willReturn(false)
        ;

        $result = $this->jobUniqueService->isUnique($jobId);

        self::assertFalse($result);
    }
}
