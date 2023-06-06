<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\Persistence;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Publishing\Cms\Application\Model\Article\Article;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class DoctrineArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $job): void
    {
        if (null !== ($this->find($job->getId()))) {
            //throw JobFeedAlreadyExist::withId($job->getId());
        }
        $this->getEntityManager()->persist($job);
        $this->getEntityManager()->flush();
    }

    public function withId(int $articleId): Article
    {
        if (null === ($jobFeed = $this->find($articleId))) {
            //throw CouldNotFindJobFeed::withId($articleId);
        }
        return $jobFeed;
    }
}
