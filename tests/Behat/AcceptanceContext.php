<?php declare(strict_types=1);

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Mink\Element\NodeElement;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @see http://behat.org/en/latest/quick_start.html
 */
final class AcceptanceContext extends MinkContext implements Context
{
    private KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Then (I )wait :count second(s)
     */
    public function iWaitSeconds(string $count): void
    {
        usleep((int) $count * 1000000);
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
        //$text = $this->enrichText($text);
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
                Assert::assertNotNull(
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
