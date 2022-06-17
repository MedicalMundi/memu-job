<?php declare(strict_types=1);

namespace App\Tests\Behat;

use App\Entity\BackofficeUser;
use Behat\Behat\Context\Context;
use Behat\Mink\Element\NodeElement;
use Behat\MinkExtension\Context\MinkContext;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Webmozart\Assert\Assert;

/**
 * @see http://behat.org/en/latest/quick_start.html
 */
final class AcceptanceContext extends MinkContext implements Context
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
     * @Given /^I am authenticated as "([^"]*)"$/
     *
     * @throws \Throwable
     */
    public function iAmAuthenticatedAs(string $email): void
    {
        $this->thereIsAnAdminUserWithEmailAndPassword($email, $email);
        $this->visit('/login');
        $this->fillField('username', $email);
        $this->fillField('password', $email);

        $this->pressButton('login');
        $this->iWaitForTextToAppear('BackOffice', 200);
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

    /**
     * @Then (I )wait :count second(s)
     */
    public function iWaitSeconds(string $count): void
    {
        usleep((int) $count * 1_000_000);
    }

    /**
     * @When  I wait for :text to appear
     *
     * @Then  I should see :text appear
     *
     * @throws \Throwable
     */
    public function iWaitForTextToAppear(string $text, ?int $tries = 125): void
    {
        $this->spin(
            function () use ($text): void {
                $this->assertPageContainsText($text);
            },
            $tries,
        );
        $this->assertPageContainsText($text);
    }

    private function getNodeElement(string $locator, ?int $tries = 25): NodeElement
    {
        return $this->spin(
            function () use ($locator) {
                $element = $this->getSession()->getPage()->find('css', $locator);
                Assert::notNull(
                    $element,
                    sprintf(
                        'locator "%s" not found on page %s',
                        $locator,
                        $this->getSession()->getCurrentUrl()
                    )
                );

                return $element;
            },
            $tries
        );
    }

    private function getTestElement(string $dataTestLocator, int $tries = 25): NodeElement
    {
        return $this->getNodeElement("[data-test='$dataTestLocator']", $tries);
    }

    private function spin(\Closure $closure, ?int $tries = 25): ?NodeElement
    {
        for ($i = 0; $i <= $tries; $i++) {
            try {
                return $closure();
            } catch (\Throwable $e) {
                if ($i === $tries) {
                    throw $e;
                }
            }

            usleep(100000); // 100 milliseconds
        }
    }
}
