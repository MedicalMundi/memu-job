<?php declare(strict_types=1);

namespace WebSiteBFF\Adapter\HttpWeb;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    /**
     * @Route("/chi-siamo", name="website_about_us")
     */
    public function index(): Response
    {
        return $this->render('@website/about_us/index.html.twig', [
            'message' => 'Welcome to MedicalJob!',
        ]);
    }
}
