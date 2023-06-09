<?php declare(strict_types=1);

namespace WebSiteBFF\Adapter\HttpWeb;

use Publishing\Cms\AdapterDistributedData\CmsDistributedData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function index(): Response
    {
        // get data (published job article) from cms context

        //filter or serialize, paginate

        // serve data by template
        $data = $this->cmsDistributedData->getAllPublishedJobArticle();

        return $this->render('@website/lavoro/index.html.twig', [
            'data' => $data,
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
