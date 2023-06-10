<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb\Ingesting;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/ingesting")
 * @IsGranted("ROLE_ADMIN")
 */
class IngestingController extends AbstractController
{
    private const USE_VUE = false;

    /**
     * @Route("/", name="backoffice_ingesting", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('@backoffice/ingesting/index.html.twig', [
            'useVue' => self::USE_VUE,
        ]);
    }
}
