<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Unit\Model\Service;

use Ingesting\PublicJob\Application\Model\JobRepository;
use Ingesting\PublicJob\Application\Model\Service\UniqueJobLinkService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\PublicJob\Application\Model\Service\UniqueJobLinkService
 */
class UniqueJobLinkServiceTest extends TestCase
{
    private const A_JOB_LINK = 'https://www.irrelevant-link.com/84208340';

    /**
     * @var JobRepository & MockObject
     */
    private $repository;

    private UniqueJobLinkService $UniqueJobLinkService;

    protected function setUp(): void
    {
        $this->repository = $this->getMockBuilder(JobRepository::class)->getMock();

        $this->UniqueJobLinkService = new UniqueJobLinkService($this->repository);
    }

    /**
     * @test
     */
    public function shouldDetectAUniqueLink(): void
    {
        $this->repository->expects(self::once())
            ->method('isUniqueLink')
            ->willReturn(true)
        ;

        $result = $this->UniqueJobLinkService->isUniqueLink(self::A_JOB_LINK);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function shouldNotDetectDuplicateLink(): void
    {
        $this->repository->expects(self::once())
            ->method('isUniqueLink')
            ->willReturn(false)
        ;

        $result = $this->UniqueJobLinkService->isUniqueLink(self::A_JOB_LINK);

        self::assertFalse($result);
    }
}
