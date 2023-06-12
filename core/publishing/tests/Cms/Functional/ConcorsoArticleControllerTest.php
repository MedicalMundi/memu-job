<?php declare(strict_types=1);

namespace Publishing\Tests\Cms\Functional;

use Publishing\Cms\Adapter\Persistence\ConcorsoArticleRepository;
use Publishing\Cms\Application\Model\ConcorsoArticle\ConcorsoArticle;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @covers \Publishing\Cms\Adapter\HttpWeb\ConcorsoArticleController
 * @group io-database
 */
class ConcorsoArticleControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    private ConcorsoArticleRepository $repository;

    private string $path = '/backoffice/publishing/concorso/article/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(ConcorsoArticle::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ConcorsoArticle index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = \count($this->repository->findAll());

        //$this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'concorso_article[title]' => 'Testing',
            'concorso_article[content]' => 'Testing',
            'concorso_article[publicationStart]' => '2023-06-09 00:00:00',
            'concorso_article[publicationEnd]' => '2023-06-25 00:00:00',
            'concorso_article[isDraft]' => true,
        ]);

        self::assertResponseRedirects('/backoffice/publishing/concorso/article/');

        self::assertSame($originalNumObjectsInRepository + 1, \count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $fixture = new ConcorsoArticle();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Title');
        $fixture->setPublicationStart(null);
        $fixture->setPublicationEnd(null);
        $fixture->setIsDraft(true);

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()->toString()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ConcorsoArticle');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $fixture = new ConcorsoArticle();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Title');
        $fixture->setPublicationStart(null);
        $fixture->setPublicationEnd(null);
        $fixture->setIsDraft(false);

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()->toString()));

        $this->client->submitForm('Update', [
            'concorso_article[title]' => 'Something New',
            'concorso_article[content]' => 'Something New',
            'concorso_article[publicationStart]' => '',
            'concorso_article[publicationEnd]' => '',
            'concorso_article[isDraft]' => true,
        ]);

        self::assertResponseRedirects('/backoffice/publishing/concorso/article/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getContent());
        self::assertSame(null, $fixture[0]->getPublicationStart());
        self::assertSame(null, $fixture[0]->getPublicationEnd());
        self::assertSame(true, $fixture[0]->getIsDraft());
    }

    public function testRemove(): void
    {
        $originalNumObjectsInRepository = \count($this->repository->findAll());

        $fixture = new ConcorsoArticle();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Title');
        $fixture->setPublicationStart(null);
        $fixture->setPublicationEnd(null);
        $fixture->setIsDraft(false);

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, \count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()->toString()));
        $this->client->submitForm('Elimina');

        self::assertSame($originalNumObjectsInRepository, \count($this->repository->findAll()));
        self::assertResponseRedirects('/backoffice/publishing/concorso/article/');
    }
}
