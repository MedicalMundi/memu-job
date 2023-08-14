<?php declare(strict_types=1);

namespace Ingesting\Errata\Infrastructure;

use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ProductionServiceContainer extends ServiceContainer
{
    public function __construct(
        protected ?ErrataFeedRepository $errataFeedRepository,
        protected ?LoggerInterface $logger = null
    ) {
    }

    protected function errataFeedRepository(): ErrataFeedRepository
    {
        if ($this->errataFeedRepository === null) {
            throw new \RuntimeException('Doctrine ErrataFeedRepository is missing');
        }

        return $this->errataFeedRepository;
    }

    protected function logger(): LoggerInterface
    {
        if ($this->logger === null) {
            $this->logger = new NullLogger();
        }

        return $this->logger;
    }
}
