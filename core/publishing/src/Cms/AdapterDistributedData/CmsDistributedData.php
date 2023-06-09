<?php declare(strict_types=1);

namespace Publishing\Cms\AdapterDistributedData;

use Publishing\Cms\Adapter\Persistence\ConcorsoArticleRepository;
use Publishing\Cms\Adapter\Persistence\JobArticleRepository;

class CmsDistributedData
{
    private JobArticleRepository $jobArticleRepository;

    private ConcorsoArticleRepository  $concorsoArticleRepository;

    public function __construct(JobArticleRepository $jobArticleRepository, ConcorsoArticleRepository $concorsoArticleRepository)
    {
        $this->jobArticleRepository = $jobArticleRepository;
        $this->concorsoArticleRepository = $concorsoArticleRepository;
    }

    public function getAllPublishedJobArticle(): array
    {
        return $this->jobArticleRepository->findAll();
    }

    public function getJobArticleById(int $id): array
    {
        return [$this->jobArticleRepository->findById($id)];
    }

    public function getAllPublishedConcorsoArticle(): array
    {
        return $this->concorsoArticleRepository->findAll();
    }

    public function getConcorsoArticleById(int $id): array
    {
        return [$this->concorsoArticleRepository->findById($id)];
    }
}
