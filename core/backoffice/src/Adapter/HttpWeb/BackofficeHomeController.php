<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackofficeHomeController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route(path: '/backoffice', name: 'backoffice_home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('@backoffice/home/index.html.twig', [
            'message' => 'Backoffice MedicalMundi!',
        ]);
    }
}
