<?php declare(strict_types=1);

namespace WebSiteBFF\Adapter\HttpWeb;

use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Modelling\EventBus;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Publishing\Cms\AdapterDistributedData\CmsDistributedData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcorsiController extends AbstractController
{
    public function __construct(
        private CmsDistributedData $cmsDistributedData
    ) {
    }

    #[Route(path: '/concorsi', name: 'website_concorsi')]
    public function index(Request $request): Response
    {
        $data = $this->cmsDistributedData->getAllPublishedConcorsoArticles();

        $pager = new Pagerfanta(
            new ArrayAdapter($data)
        );

        $pager->setMaxPerPage(2);
        $pager->setCurrentPage((int) $request->query->get('page', '1'));

        return $this->render('@website/concorsi/index.html.twig', [
            'pager' => $pager,
        ]);
    }

    #[Route(path: '/concorsi/{id}/show', name: 'website_concorso_show')]
    public function show(string $id, EventBus $eventBus): Response
    {
        // get data (published job article) from cms context

        //filter or serialize, paginate

        // serve data by template
        $data = $this->cmsDistributedData->getConcorsoArticleById($id);

        $eventBus->publishWithRouting(
            'website_bff_service.article.viewed',
            [
                'article_id' => $id,
            ],
            MediaType::APPLICATION_JSON
        );

        return $this->render('@website/concorsi/show.html.twig', [
            'data' => $data,
        ]);
    }
}
