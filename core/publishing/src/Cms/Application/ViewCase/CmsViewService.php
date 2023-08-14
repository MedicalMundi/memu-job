<?php declare(strict_types=1);

namespace Publishing\Cms\Application\ViewCase;

use Publishing\Cms\Adapter\Persistence\JobArticleRepository;

class CmsViewService
{
    public function __construct(
        private JobArticleRepository $jobArticleRepository
    ) {
    }

    public function viewAllJobArticle(array $requestParams = [], int $max = 10): array
    {
        return $this->jobArticleRepository->findAll();
    }
}
