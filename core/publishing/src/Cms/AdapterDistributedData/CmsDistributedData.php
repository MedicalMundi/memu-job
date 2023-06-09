<?php declare(strict_types=1);

namespace Publishing\Cms\AdapterDistributedData;

use Publishing\Cms\Adapter\Persistence\JobArticleRepository;

class CmsDistributedData
{
    private JobArticleRepository $jobArticleRepository;

    public function __construct(JobArticleRepository $jobArticleRepository)
    {
        $this->jobArticleRepository = $jobArticleRepository;
    }

    public function getAllPublishedJobArticle(): array
    {
        return $this->jobArticleRepository->findAll();
    }

    public function getJobArticleById(int $id): array
    {
        return [$this->jobArticleRepository->findById($id)];
    }
}
