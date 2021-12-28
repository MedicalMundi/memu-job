<?php declare(strict_types=1);

namespace Ingesting\Errata\Adapter\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ingesting\Errata\Application\Model\CouldNotFindErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeed;
use Ingesting\Errata\Application\Model\ErrataFeedAlreadyExist;
use Ingesting\Errata\Application\Model\ErrataFeedRepository;
use Ingesting\Errata\Application\Model\ErrataId;

/**
 * @method ErrataFeed|null find($id, $lockMode = null, $lockVersion = null)
 * @method ErrataFeed|null findOneBy(array $criteria, array $orderBy = null)
 * @method ErrataFeed[]    findAll()
 * @method ErrataFeed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineErrataFeedRepository extends ServiceEntityRepository implements ErrataFeedRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ErrataFeed::class);
    }

    public function save(ErrataFeed $errata): void
    {
        if (null !== ($this->find($errata->id()))) {
            throw ErrataFeedAlreadyExist::withId($errata->id());
        }
        $this->_em->persist($errata);
        $this->_em->flush($errata);
    }

    public function withId(ErrataId $errataId): ErrataFeed
    {
        if (null === ($errataFeed = $this->find($errataId))) {
            throw CouldNotFindErrataFeed::withId($errataId);
        }
        return $errataFeed;
    }

    public function isUniqueIdentity(ErrataId $errataId): bool
    {
        $result = false;
        if (null === ($this->find($errataId))) {
            $result = true;
        }
        return $result;
    }

    public function isUniqueLink(string $errataLink): bool
    {
        $result = false;
        if (null === $this->findOneBy([
            'link' => $errataLink,
        ])) {
            $result = true;
        }
        return $result;
    }
}
