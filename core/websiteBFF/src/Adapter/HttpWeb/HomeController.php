<?php declare(strict_types=1);

namespace WebSiteBFF\Adapter\HttpWeb;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="website_home")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        return $this->render('@website/home/index.html.twig', [
            'message' => 'Welcome to MedicalJob!',
        ]);
    }
}
