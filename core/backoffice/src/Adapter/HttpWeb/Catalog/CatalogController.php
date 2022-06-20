<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb\Catalog;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/catalog")
 */
class CatalogController extends AbstractController
{
    /**
     * @Route("/", name="backoffice_catalog")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        return $this->render('@backoffice/catalog/index.html.twig', [

        ]);
    }
}
