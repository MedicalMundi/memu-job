<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb;

use Publishing\Cms\Adapter\HttpWeb\Form\JobArticleType;
use Publishing\Cms\Adapter\Persistence\JobArticleRepository;
use Publishing\Cms\Application\Model\JobArticle\JobArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/job/article")
 */
class JobArticleController extends AbstractController
{
    /**
     * @Route("/", name="cms_job_article_index", methods={"GET"})
     */
    public function index(JobArticleRepository $jobArticleRepository): Response
    {
        return $this->render('@cms/job_article/index.html.twig', [
            'job_articles' => $jobArticleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cms_job_article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, JobArticleRepository $jobArticleRepository): Response
    {
        $jobArticle = new JobArticle();
        $form = $this->createForm(JobArticleType::class, $jobArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobArticleRepository->add($jobArticle, true);

            $this->addFlash('success', 'JobArticle creato');

            return $this->redirectToRoute('cms_job_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@cms/job_article/new.html.twig', [
            'job_article' => $jobArticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="cms_job_article_show", methods={"GET"})
     */
    public function show(JobArticle $jobArticle): Response
    {
        return $this->render('@cms/job_article/show.html.twig', [
            'job_article' => $jobArticle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cms_job_article_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, JobArticle $jobArticle, JobArticleRepository $jobArticleRepository): Response
    {
        $form = $this->createForm(JobArticleType::class, $jobArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobArticleRepository->add($jobArticle, true);

            return $this->redirectToRoute('cms_job_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('@cms/job_article/edit.html.twig', [
            'job_article' => $jobArticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="cms_job_article_delete", methods={"POST"})
     */
    public function delete(Request $request, JobArticle $jobArticle, JobArticleRepository $jobArticleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $jobArticle->getId(), (string) $request->request->get('_token'))) {
            $jobArticleRepository->remove($jobArticle, true);
        }

        return $this->redirectToRoute('cms_job_article_index', [], Response::HTTP_SEE_OTHER);
    }
}
