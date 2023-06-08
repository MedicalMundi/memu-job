<?php declare(strict_types=1);

namespace Publishing\Cms\Application\ViewCase;

use Publishing\Cms\Adapter\Persistence\JobArticleRepository;

class CmsViewService
{
    private JobArticleRepository $jobArticleRepository;

    public function __construct(JobArticleRepository $jobArticleRepository)
    {
        $this->jobArticleRepository = $jobArticleRepository;
    }

    public function viewAllJobArticle(array $requestParams = [], int $max = 10): array
    {
        return $this->jobArticleRepository->findAll();
    }
}
