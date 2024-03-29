<?php declare(strict_types=1);

namespace Publishing\Cms\AdapterDistributedData;

use Publishing\Cms\Adapter\Persistence\ConcorsoArticleRepository;
use Publishing\Cms\Adapter\Persistence\JobArticleRepository;

class CmsDistributedData
{
    public function __construct(
        private JobArticleRepository $jobArticleRepository,
        private ConcorsoArticleRepository $concorsoArticleRepository
    ) {
    }

    public function getAllPublishedJobArticle(): array
    {
        return $this->jobArticleRepository->findAll();
    }

    public function getJobArticleById(int $id): array
    {
        return [$this->jobArticleRepository->findById($id)];
    }

    public function getAllPublishedConcorsoArticles(): array
    {
        return $this->concorsoArticleRepository->findPublishedConcorsoArticles();
    }

    public function getConcorsoArticleById(string $id): array
    {
        return [$this->concorsoArticleRepository->findById($id)];
    }
}
