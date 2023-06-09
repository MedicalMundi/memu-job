<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb;

use Publishing\Cms\Adapter\HttpWeb\Form\ConcorsoArticleType;
use Publishing\Cms\Adapter\Persistence\ConcorsoArticleRepository;
use Publishing\Cms\Application\Model\ConcorsoArticle\ConcorsoArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/concorso/article")
 */
class ConcorsoArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_concorso_article_index", methods={"GET"})
     */
    public function index(ConcorsoArticleRepository $concorsoArticleRepository): Response
    {
        return $this->render('@cms/concorso_article/index.html.twig', [
            'concorso_articles' => $concorsoArticleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_concorso_article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ConcorsoArticleRepository $concorsoArticleRepository): Response
    {
        $concorsoArticle = new ConcorsoArticle();
        $form = $this->createForm(ConcorsoArticleType::class, $concorsoArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $concorsoArticleRepository->add($concorsoArticle, true);

            return $this->redirectToRoute('app_concorso_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@cms/concorso_article/new.html.twig', [
            'concorso_article' => $concorsoArticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_concorso_article_show", methods={"GET"})
     */
    public function show(ConcorsoArticle $concorsoArticle): Response
    {
        return $this->render('@cms/concorso_article/show.html.twig', [
            'concorso_article' => $concorsoArticle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_concorso_article_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ConcorsoArticle $concorsoArticle, ConcorsoArticleRepository $concorsoArticleRepository): Response
    {
        $form = $this->createForm(ConcorsoArticleType::class, $concorsoArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $concorsoArticleRepository->add($concorsoArticle, true);

            return $this->redirectToRoute('app_concorso_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@cms/concorso_article/edit.html.twig', [
            'concorso_article' => $concorsoArticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_concorso_article_delete", methods={"POST"})
     */
    public function delete(Request $request, ConcorsoArticle $concorsoArticle, ConcorsoArticleRepository $concorsoArticleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $concorsoArticle->getId(), (string) $request->request->get('_token'))) {
            $concorsoArticleRepository->remove($concorsoArticle, true);
        }

        return $this->redirectToRoute('app_concorso_article_index', [], Response::HTTP_SEE_OTHER);
    }
}
