<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Adapter\HttpWeb;

use Ingesting\PublicJob\Application\Usecase\ShowFeed\ShowAllFeedJob;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebApiController extends AbstractController
{
    private ShowAllFeedJob $viewcase;

    public function __construct(ShowAllFeedJob $viewcase)
    {
        $this->viewcase = $viewcase;
    }

    /**
     * @Route("/wapi/ingestion/jobfeed", name="ingestion_jobfeed", methods={"GET"})
     */
    public function showFeedJob(Request $request): Response
    {
        $data = $this->viewcase->showFeedJob();

        return $this->json($data);
    }
}
