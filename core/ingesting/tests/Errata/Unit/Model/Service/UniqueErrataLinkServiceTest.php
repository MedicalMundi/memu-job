<?php declare(strict_types=1);

namespace Ingesting\Tests\Errata\Unit\Model\Service;

use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\Service\UniqueErrataLinkService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\Errata\Application\Model\Service\UniqueErrataLinkService
 */
class UniqueErrataLinkServiceTest extends TestCase
{
    private const A_JOB_LINK = 'https://www.irrelevant-link.com/84208340';

    /**
     * @var ErrataFeedRepository & MockObject
     */
    private $repository;

    private UniqueErrataLinkService $UniqueErrataLinkService;

    protected function setUp(): void
    {
        $this->repository = $this->getMockBuilder(ErrataFeedRepository::class)->getMock();

        $this->UniqueErrataLinkService = new UniqueErrataLinkService($this->repository);
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

        $result = $this->UniqueErrataLinkService->isUniqueLink(self::A_JOB_LINK);

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

        $result = $this->UniqueErrataLinkService->isUniqueLink(self::A_JOB_LINK);

        self::assertFalse($result);
    }
}
