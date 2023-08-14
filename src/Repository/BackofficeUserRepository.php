<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\BackofficeUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<BackofficeUser>
 *
 * @method BackofficeUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method BackofficeUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method BackofficeUser[]    findAll()
 * @method BackofficeUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BackofficeUserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BackofficeUser::class);
    }

    public function add(BackofficeUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BackofficeUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (! $user instanceof BackofficeUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }
}
