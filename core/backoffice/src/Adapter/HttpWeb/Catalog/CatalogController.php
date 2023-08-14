<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb\Catalog;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
#[Route(path: '/backoffice/catalog')]
class CatalogController extends AbstractController
{
    private const USE_VUE = false;

    #[Route(path: '/', name: 'backoffice_catalog', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('@backoffice/catalog/index.html.twig', [
            'useVue' => self::USE_VUE,
        ]);
    }
}
