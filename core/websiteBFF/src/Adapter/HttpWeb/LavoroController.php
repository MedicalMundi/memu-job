<?php declare(strict_types=1);

namespace WebSiteBFF\Adapter\HttpWeb;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Publishing\Cms\AdapterDistributedData\CmsDistributedData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LavoroController extends AbstractController
{
    private CmsDistributedData $cmsDistributedData;

    public function __construct(CmsDistributedData $cmsDistributedData)
    {
        $this->cmsDistributedData = $cmsDistributedData;
    }

    /**
     * @Route("/lavoro", name="website_lavoro")
     */
    public function index(Request $request): Response
    {
        $data = $this->cmsDistributedData->getAllPublishedJobArticle();

        $pager = new Pagerfanta(
            new ArrayAdapter($data)
        );

        $pager->setMaxPerPage(2);
        $pager->setCurrentPage((int) $request->query->get('page', '1'));

        return $this->render('@website/lavoro/index.html.twig', [
            'pager' => $pager,
        ]);
    }

    /**
     * @Route("/lavoro/{id}", name="website_lavoro_show")
     */
    public function show(int $id): Response
    {
        // get data (published job article) from cms context

        //filter or serialize, paginate

        // serve data by template
        $data = $this->cmsDistributedData->getJobArticleById($id);

        return $this->render('@website/lavoro/show.html.twig', [
            'data' => $data,
        ]);
    }
}
