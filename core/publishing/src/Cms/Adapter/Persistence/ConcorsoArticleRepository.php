<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\Persistence;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Publishing\Cms\Application\Model\ConcorsoArticle\ConcorsoArticle;

/**
 * @extends ServiceEntityRepository<ConcorsoArticle>
 *
 * @method ConcorsoArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConcorsoArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConcorsoArticle[]    findAll()
 * @method ConcorsoArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcorsoArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConcorsoArticle::class);
    }

    public function add(ConcorsoArticle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ConcorsoArticle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ConcorsoArticle[] Returns an array of ConcorsoArticle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ConcorsoArticle
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findById(string $id): ?ConcorsoArticle
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findPublishedConcorsoArticles(\DateTimeImmutable $currentDate = null): array
    {
        $currentDate ??= new \DateTimeImmutable('now');

        $qb = $this->createQueryBuilder('c');
        $qb->where('c.publicationStart <= :publicationStart')
            ->andWhere('c.publicationEnd >= :publicationEnd')
            ->andWhere('c.isDraft = 0')
            ->orderBy('c.publicationStart')
            ->setParameter('publicationStart', $currentDate->format('Y-m-d'))
            ->setParameter('publicationEnd', $currentDate->format('Y-m-d'));

        $result = $qb->getQuery()
            ->getResult();

        return $result;
    }
}
