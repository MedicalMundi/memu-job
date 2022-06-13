<?php declare(strict_types=1);

namespace App\Tests\Behat;

use App\Entity\BackofficeUser;
use Behat\Behat\Context\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @see http://behat.org/en/latest/quick_start.html
 */
final class AuthenticationContext implements Context
{
    private KernelInterface $kernel;

    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(KernelInterface $kernel, UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->kernel = $kernel;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    /**
     * @BeforeScenario
     */
    public function clearData(): void
    {
        $em = $this->kernel->getContainer()->get('doctrine')->getManager();

        $em->createQuery('DELETE FROM App:BackofficeUser')->execute();
    }

    /**
     * @Given there is an admin user with email :email and password :password
     */
    public function thereIsAnAdminUserWithEmailAndPassword(string $email, string $password): void
    {
        $adminUser = BackofficeUser::create($email, '');

        $adminUser = $adminUser->setPassword($this->userPasswordHasher->hashPassword($adminUser, $password));

        $adminUser->setRoles(['ROLE_ADMIN']);

        $em = $this->kernel->getContainer()->get('doctrine')->getManager();
        $em->persist($adminUser);
        $em->flush();
    }
}
