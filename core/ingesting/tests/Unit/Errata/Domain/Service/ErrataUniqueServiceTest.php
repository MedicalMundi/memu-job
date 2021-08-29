<?php declare(strict_types=1);

namespace Ingesting\Tests\Unit\Errata\Domain\Service;

use Ingesting\Errata\Application\Domain\Model\ErrataFeed;
use Ingesting\Errata\Application\Domain\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Domain\Model\ErrataId;
use Ingesting\Errata\Application\Domain\Model\Service\ErrataUniqueService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\Errata\Application\Domain\Model\Service\ErrataUniqueService
 */
class ErrataUniqueServiceTest extends TestCase
{
    /**
     * @var ErrataFeedRepository & MockObject
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
        $errataId = ErrataId::fromString($uuid = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0');

        $this->repository->expects(self::once())
            ->method('withId')
            ->willReturn($this->createErrataFeedItem($errataId))
            ;

        $result = $this->errataUniqueService->isUnique($errataId);

        self::assertFalse($result);
    }

    /**
     * @test
     */
    public function shouldNotDetectDuplicateIdentity(): void
    {
        $errataId = ErrataId::fromString($uuid = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0');

        $this->repository->expects(self::once())
            ->method('withId')
        ;

        $result = $this->errataUniqueService->isUnique($errataId);

        self::assertFalse($result);
    }

    private function createErrataFeedItem(?ErrataId $id): ErrataFeed
    {
        return ErrataFeed::create('a title', 'a description', 'https://www.google.com', '2047-02-01 10:00:00', $id);
    }
}
