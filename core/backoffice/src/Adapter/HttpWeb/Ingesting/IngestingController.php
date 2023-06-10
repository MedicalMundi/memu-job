<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb\Ingesting;

use Ingesting\PublicJob\AdapterDistributedData\IngestingDistributedData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/ingesting")
 * @IsGranted("ROLE_ADMIN")
 */
class IngestingController extends AbstractController
{
    private const USE_VUE = false;

    private IngestingDistributedData $ingestingDistributedData;

    public function __construct(IngestingDistributedData $ingestingDistributedData)
    {
        $this->ingestingDistributedData = $ingestingDistributedData;
    }

    /**
     * @Route("/", name="backoffice_ingesting", methods={"GET"})
     */
    public function index(): Response
    {
        $data = $this->ingestingDistributedData->findAllJobFeed();

        return $this->render('@backoffice/ingesting/index.html.twig', [
            'useVue' => self::USE_VUE,
            'data' => $data,
        ]);
    }

    /**
     * @Route("/jobfeed/{id}/show", name="backoffice_ingesting_show_job_feed", methods={"GET"})
     */
    public function showFeed(Request $request): Response
    {
        $id = (string) $request->get('id');
        $data = $this->ingestingDistributedData->findJobFeedById($id);

        return $this->render('@backoffice/ingesting/show_feed.html.twig', [
            'useVue' => self::USE_VUE,
            'data' => $data,
        ]);
    }
}
