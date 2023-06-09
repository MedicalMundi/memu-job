<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\Persistence;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Publishing\Cms\Application\Model\JobArticle\JobArticle;

/**
 * @extends ServiceEntityRepository<JobArticle>
 *
 * @method JobArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobArticle[]    findAll()
 * @method JobArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobArticle::class);
    }

    public function add(JobArticle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JobArticle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return JobArticle[] Returns an array of JobArticle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JobArticle
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

//  READ SIDE
    public function findById(int $id): ?JobArticle
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
