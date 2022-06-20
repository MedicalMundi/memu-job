<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackofficeHomeController extends AbstractController
{
    /**
     * @Route("/backoffice", name="backoffice_home", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        return $this->render('@backoffice/home/index.html.twig', [
            'message' => 'Backoffice MedicalMundi!',
        ]);
    }
}
