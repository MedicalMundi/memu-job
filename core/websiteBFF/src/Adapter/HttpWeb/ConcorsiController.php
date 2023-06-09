<?php declare(strict_types=1);

namespace WebSiteBFF\Adapter\HttpWeb;

use Publishing\Cms\AdapterDistributedData\CmsDistributedData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcorsiController extends AbstractController
{
    private CmsDistributedData $cmsDistributedData;

    public function __construct(CmsDistributedData $cmsDistributedData)
    {
        $this->cmsDistributedData = $cmsDistributedData;
    }

    /**
     * @Route("/concorsi", name="website_concorsi")
     */
    public function index(): Response
    {
        $data = $this->cmsDistributedData->getAllPublishedConcorsoArticle();

        return $this->render('@website/concorsi/index.html.twig', [
            'data' => $data,
        ]);
    }
}
