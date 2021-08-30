<?php declare(strict_types=1);

namespace Ingesting\Errata\Infrastructure;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ProductionServiceContainer extends ServiceContainer
{
    protected ?LoggerInterface $logger = null;

    public function __construct(?LoggerInterface $logger = null)
    {
        $this->logger = $logger ?? $logger;
    }

    protected function logger(): LoggerInterface
    {
        if ($this->logger === null) {
            $this->logger = new NullLogger();
        }

        return $this->logger;
    }
}
