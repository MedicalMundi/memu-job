<?php declare(strict_types=1);

namespace Publishing\Tests\Cms\Functional;

use Publishing\Cms\Adapter\Persistence\JobArticleRepository;
use Publishing\Cms\Application\Model\JobArticle\JobArticle;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @covers \Publishing\Cms\Adapter\HttpWeb\JobArticleController
 * @group io-database
 */
class JobArticleControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    private JobArticleRepository $repository;

    private string $path = '/job/article/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(JobArticle::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('JobArticle index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = \count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'job_article[title]' => 'Testing',
            'job_article[content]' => 'Testing',
            'job_article[pubicationStart]' => '2023-01-01',
            'job_article[publicationEnd]' => '2024-01-01',
        ]);

        self::assertResponseRedirects('/job/article/');

        self::assertSame($originalNumObjectsInRepository + 1, \count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        //$this->markTestIncomplete();
        $fixture = new JobArticle();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Title');
        $fixture->setPubicationStart(null);
        $fixture->setPublicationEnd(null);

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('JobArticle');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new JobArticle();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Title');
        $fixture->setPubicationStart(null);
        $fixture->setPublicationEnd(null);

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'job_article[title]' => 'Something New',
            'job_article[content]' => 'Something New',
            'job_article[pubicationStart]' => 'Something New',
            'job_article[publicationEnd]' => 'Something New',
        ]);

        self::assertResponseRedirects('/job/article/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getContent());
        self::assertSame('Something New', $fixture[0]->getPubicationStart());
        self::assertSame('Something New', $fixture[0]->getPublicationEnd());
    }

    public function testRemove(): void
    {
        //$this->markTestIncomplete();

        $originalNumObjectsInRepository = \count($this->repository->findAll());

        $fixture = new JobArticle();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Title');
        $fixture->setPubicationStart(null);
        $fixture->setPublicationEnd(null);

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, \count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, \count($this->repository->findAll()));
        self::assertResponseRedirects('/job/article/');
    }
}
