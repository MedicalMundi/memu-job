<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Infrastructure;

use Ingesting\PublicJob\Application\Model\JobRepository;

class ProductionServiceContainer extends ServiceContainer
{
    public function __construct(
        protected ?JobRepository $jobRepository = null
    ) {
    }

    protected function jobRepository(): JobRepository
    {
        if ($this->jobRepository === null) {
            throw new \RuntimeException('Doctrine JobFeedRepository is missing');
        }

        return $this->jobRepository;
    }
}
