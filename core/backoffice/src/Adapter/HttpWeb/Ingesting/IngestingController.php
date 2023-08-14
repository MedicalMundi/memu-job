<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb\Ingesting;

use Ingesting\PublicJob\AdapterDistributedData\IngestingDistributedData;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
#[Route(path: '/backoffice/ingesting')]
class IngestingController extends AbstractController
{
    private const USE_VUE = false;

    public function __construct(
        private IngestingDistributedData $ingestingDistributedData
    ) {
    }

    #[Route(path: '/', name: 'backoffice_ingesting', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $data = $this->ingestingDistributedData->findAllJobFeed();

        $pager = new Pagerfanta(
            new ArrayAdapter($data)
        );

        $pager->setMaxPerPage(20);
        $pager->setCurrentPage((int) $request->query->get('page', '1'));

        return $this->render('@backoffice/ingesting/index.html.twig', [
            'useVue' => self::USE_VUE,
            'pager' => $pager,
        ]);
    }

    #[Route(path: '/jobfeed/{id}/show', name: 'backoffice_ingesting_show_job_feed', methods: ['GET'])]
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
