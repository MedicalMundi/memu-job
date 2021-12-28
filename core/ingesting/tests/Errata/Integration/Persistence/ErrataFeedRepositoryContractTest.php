<?php declare(strict_types=1);

namespace Ingesting\Tests\Errata\Integration\Persistence;

use DateTimeImmutable;
use Ingesting\Errata\Application\Model\ErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeedAlreadyExist;
use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\ErrataId;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class ErrataFeedRepositoryContractTest extends KernelTestCase
{
    private const TITLE = 'Feed irrelevant title';

    private const DESCRIPTION = 'Feed irrelevant description';

    private const LINK = 'https://www.gazzettaufficiale.it';

    private const PUB_DATE = 'Thu, 25 Apr 2019 20:00:00 GMT';

    /**
     * @var ErrataFeedRepository
     */
    private $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createRepository();
    }

    abstract protected function createRepository(): ErrataFeedRepository;

    /**
     * @test
     */
    public function it_can_persist_data(): void
    {
        $identity = ErrataId::generate();
        $errataFeed = $this->createErrataFeed($identity);
        $this->repository->save($errataFeed);

        $persistedItem = $this->verifyItemById($identity);
        self::assertEquals(self::TITLE, $persistedItem->title());
        self::assertEquals(self::DESCRIPTION, $persistedItem->description());
        self::assertEquals(self::LINK, $persistedItem->link());
        self::assertEquals(new DateTimeImmutable(self::PUB_DATE), $persistedItem->publicationDate());
    }

    /**
     * @test
     * @covers \Ingesting\Errata\Application\Model\ErrataFeedAlreadyExist
     */
    public function duplicate_identity_should_throw_exception(): void
    {
        $this->expectException(ErrataFeedAlreadyExist::class);

        $identity = ErrataId::generate();
        $errataFeed = $this->createErrataFeed($identity);
        $this->repository->save($errataFeed);

        $this->repository->save($errataFeed);
    }

    /**
     * @test
     */
    public function should_detect_unique_identity(): void
    {
        $identity = ErrataId::generate();

        $result = $this->repository->isUniqueIdentity($identity);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function should_detect_a_not_unique_identity(): void
    {
        $identity = ErrataId::generate();
        $jobFeed = $this->createErrataFeed($identity);
        $this->repository->save($jobFeed);

        $result = $this->repository->isUniqueIdentity($identity);

        self::assertFalse($result);
    }

    /**
     * @test
     */
    public function should_detect_unique_link(): void
    {
        $result = $this->repository->isUniqueLink(self::LINK);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function should_detect_a_not_unique_link(): void
    {
        $identity = ErrataId::generate();
        $errataFeed = $this->createErrataFeed($identity);
        $this->repository->save($errataFeed);

        $result = $this->repository->isUniqueLink(self::LINK);

        self::assertFalse($result);
    }

    protected function createErrataFeed(ErrataId $id): ErrataFeed
    {
        $data = ErrataFeed::create(
            self::TITLE,
            self::DESCRIPTION,
            self::LINK,
            new DateTimeImmutable(self::PUB_DATE),
            $id,
        );

        return $data;
    }

    protected function verifyItemById(ErrataId $id): ErrataFeed
    {
        return $this->repository->withId($id);
    }
}
