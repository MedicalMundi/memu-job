<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Infrastructure;

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
            throw new \RuntimeException('Doctrine JobFeedRepository is missing');
        }

        return $this->jobRepository;
    }
}
