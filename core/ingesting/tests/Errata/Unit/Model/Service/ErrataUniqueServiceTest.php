<?php declare(strict_types=1);

namespace Ingesting\Tests\Errata\Unit\Model\Service;

use Ingesting\Errata\Application\Model\ErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\ErrataId;
use Ingesting\Errata\Application\Model\Service\ErrataUniqueService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\Errata\Application\Model\Service\ErrataUniqueService
 */
class ErrataUniqueServiceTest extends TestCase
{
    private const UUID = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';

    /**
     * @var ErrataFeedRepository&MockObject
     */
    private $repository;

    private ErrataUniqueService $errataUniqueService;

    protected function setUp(): void
    {
        $this->repository = $this->getMockBuilder(ErrataFeedRepository::class)->getMock();

        $this->errataUniqueService = new ErrataUniqueService($this->repository);
    }

    /**
     * @test
     */
    public function shouldDetectDuplicateIdentity(): void
    {
        $errataId = ErrataId::fromString(self::UUID);

        $this->repository->expects(self::once())
            ->method('isUniqueIdentity')
            ->willReturn(false)
        ;

        $result = $this->errataUniqueService->isUnique($errataId);

        self::assertFalse($result);
    }

    /**
     * @test
     */
    public function shouldNotDetectDuplicateIdentity(): void
    {
        $errataId = ErrataId::fromString(self::UUID);

        $this->repository->expects(self::once())
            ->method('isUniqueIdentity')
        ;

        $result = $this->errataUniqueService->isUnique($errataId);

        self::assertFalse($result);
    }

    private function createErrataFeedItem(?ErrataId $id): ErrataFeed
    {
        return ErrataFeed::create('a title', 'a description', 'https://www.google.com', new \DateTimeImmutable('2047-02-01 10:00:00'), $id);
    }
}
