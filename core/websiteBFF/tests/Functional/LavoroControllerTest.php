<?php declare(strict_types=1);

namespace WebSiteBFF\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @covers \WebSiteBFF\Adapter\HttpWeb\LavoroController
 * @group io-database
 */
class LavoroControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    private string $path = '/lavoro';

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testIndex(): void
    {
        self::markTestIncomplete('need login');
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('MedicalJob xxx');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }
}
