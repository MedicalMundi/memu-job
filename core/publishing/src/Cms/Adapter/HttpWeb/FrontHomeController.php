<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FrontHomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => '/core/publishing/src/Cms/Adapter/HttpWeb/FrontHomeController.php',
        ]);
    }
}
