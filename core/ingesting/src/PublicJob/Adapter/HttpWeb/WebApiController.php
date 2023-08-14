<?php declare(strict_types=1);

namespace Ingesting\PublicJob\Adapter\HttpWeb;

use Ingesting\PublicJob\Application\Usecase\ShowFeed\ShowAllFeedJob;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebApiController extends AbstractController
{
    public function __construct(
        private ShowAllFeedJob $viewcase
    ) {
    }

    #[Route(path: '/wapi/ingestion/jobfeed', name: 'ingestion_jobfeed', methods: ['GET'])]
    public function showFeedJob(): Response
    {
        $data = $this->viewcase->showFeedJob();
        return $this->json($data);
    }
}
