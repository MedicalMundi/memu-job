<?php declare(strict_types=1);

namespace Ingesting\Tests\Errata\Integration\Persistence;

use Ingesting\Errata\Adapter\Persistence\InMemoryErrataFeedRepository;
use Ingesting\Errata\Application\Model\ErrataFeedRepository;

/**
 * @covers \Ingesting\Errata\Adapter\Persistence\InMemoryErrataFeedRepository
 */
class InMemoryErrataFeedRepositoryTest extends ErrataFeedRepositoryContractTest
{
    protected function createRepository(): ErrataFeedRepository
    {
        return new InMemoryErrataFeedRepository();
    }
}
