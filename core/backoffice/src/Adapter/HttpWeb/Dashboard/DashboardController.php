<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb\Dashboard;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
#[Route(path: '/backoffice/dashboard')]
class DashboardController extends AbstractController
{
    private const USE_VUE = false;

    #[Route(path: '/', name: 'backoffice_dashboard', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('@backoffice/dashboard/index.html.twig', [
            'useVue' => self::USE_VUE,
        ]);
    }
}
