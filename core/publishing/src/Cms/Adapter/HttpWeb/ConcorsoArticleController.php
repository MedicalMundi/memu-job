<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Publishing\Cms\Adapter\HttpWeb\Form\ConcorsoArticleType;
use Publishing\Cms\Adapter\Persistence\ConcorsoArticleRepository;
use Publishing\Cms\Application\Model\ConcorsoArticle\ConcorsoArticle;
use Publishing\Cms\Application\Model\ConcorsoArticle\ConcorsoArticleId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/publishing/concorso/article")
 */
class ConcorsoArticleController extends AbstractController
{
    /**
     * @Route("/", name="cms_concorso_article_index", methods={"GET"})
     */
    public function index(Request $request, ConcorsoArticleRepository $concorsoArticleRepository): Response
    {
        $concorsoArticles = $concorsoArticleRepository->findAll();

        $pager = new Pagerfanta(
            new ArrayAdapter($concorsoArticles)
        );

        $pager->setMaxPerPage(2);
        $pager->setCurrentPage((int) $request->query->get('page', '1'));

        return $this->render('@cms/concorso_article/index.html.twig', [
            'pager' => $pager,
        ]);
    }

    /**
     * @Route("/new", name="cms_concorso_article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ConcorsoArticleRepository $concorsoArticleRepository): Response
    {
        $concorsoArticle = new ConcorsoArticle();
        $form = $this->createForm(ConcorsoArticleType::class, $concorsoArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $concorsoArticleRepository->add($concorsoArticle, true);

            $this->addFlash('success', 'Articolo creato');
            return $this->redirectToRoute('cms_concorso_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@cms/concorso_article/new.html.twig', [
            'concorso_article' => $concorsoArticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="cms_concorso_article_show", methods={"GET"})
     */
    public function show(Request $request, ConcorsoArticleRepository $concorsoArticleRepository): Response
    {
        $concorsoArticleId = ConcorsoArticleId::fromString((string) $request->get('id'));
        $concorsoArticle = $concorsoArticleRepository->findOneBy([
            'id' => $concorsoArticleId,
        ]);
        return $this->render('@cms/concorso_article/show.html.twig', [
            'concorso_article' => $concorsoArticle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cms_concorso_article_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ConcorsoArticleRepository $concorsoArticleRepository): Response
    {
        $concorsoArticleId = ConcorsoArticleId::fromString((string) $request->get('id'));
        $concorsoArticle = $concorsoArticleRepository->findOneBy([
            'id' => $concorsoArticleId,
        ]);
        $form = $this->createForm(ConcorsoArticleType::class, $concorsoArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $concorsoArticleRepository->add($concorsoArticle, true);

            $this->addFlash('success', 'Articolo modificato');
            return $this->redirectToRoute('cms_concorso_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@cms/concorso_article/edit.html.twig', [
            'concorso_article' => $concorsoArticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="cms_concorso_article_delete", methods={"POST"})
     */
    public function delete(Request $request, ConcorsoArticleRepository $concorsoArticleRepository): Response
    {
        $concorsoArticleId = ConcorsoArticleId::fromString((string) $request->get('id'));
        $concorsoArticle = $concorsoArticleRepository->findOneBy([
            'id' => $concorsoArticleId,
        ]);

        if ($this->isCsrfTokenValid('delete' . $concorsoArticle->getId()->toString(), (string) $request->request->get('_token'))) {
            $concorsoArticleRepository->remove($concorsoArticle, true);
        }

        return $this->redirectToRoute('cms_concorso_article_index', [], Response::HTTP_SEE_OTHER);
    }
}
