<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontHomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('@front/home/index.html.twig', [
            'message' => 'Welcome to MedicalMundi!',
        ]);
    }
}
