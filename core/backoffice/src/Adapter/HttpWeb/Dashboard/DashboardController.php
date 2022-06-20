<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb\Dashboard;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/dashboard")
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="backoffice_dashboard", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('@backoffice/dashboard/index.html.twig', [

        ]);
    }
}
