<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Infrastructure;

use Ingesting\PublicJob\Adapter\Persistence\InMemoryJobFeedRepository;
use Ingesting\PublicJob\Application\Model\JobRepository;

class ProductionServiceContainer extends ServiceContainer
{
    protected ?JobRepository $jobRepository = null;

    public function __construct(?JobRepository $jobRepository = null)
    {
        $this->jobRepository = $jobRepository;
    }

    protected function jobRepository(): JobRepository
    {
        if ($this->jobRepository === null) {
            /**
             * Todo remove InMemoryJobFeedRepository
             * add Doctrine repository
             */
            $this->jobRepository = new InMemoryJobFeedRepository();
        }

        return $this->jobRepository;
    }
}
