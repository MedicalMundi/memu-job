<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Adapter\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ingesting\PublicJob\Application\Model\CouldNotFindJobFeed;
use Ingesting\PublicJob\Application\Model\JobFeed;
use Ingesting\PublicJob\Application\Model\JobFeedAlreadyExist;
use Ingesting\PublicJob\Application\Model\JobId;
use Ingesting\PublicJob\Application\Model\JobRepository;

/**
 * @method JobFeed|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobFeed|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobFeed[]    findAll()
 * @method JobFeed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class DoctrineJobFeedRepository extends ServiceEntityRepository implements JobRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobFeed::class);
    }

    public function save(JobFeed $job): void
    {
        if (null !== ($this->find($job->id()))) {
            throw JobFeedAlreadyExist::withId($job->id());
        }
        $this->_em->persist($job);
        $this->_em->flush($job);
    }

    public function withId(JobId $jobId): JobFeed
    {
        if (null === ($jobFeed = $this->find($jobId))) {
            throw CouldNotFindJobFeed::withId($jobId);
        }
        return $jobFeed;
    }

    public function isUniqueIdentity(JobId $jobId): bool
    {
        $result = false;
        if (null !== ($this->find($jobId))) {
            $result = true;
        }
        return $result;
    }
}
