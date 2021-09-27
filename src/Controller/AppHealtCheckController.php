<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppHealtCheckController extends AbstractController
{
    /**
     * @Route("/sys/healt/check", name="app_healt_check")
     */
    public function index(): Response
    {
        return $this->json([
            'code' => 200,
            'status' => 'active',
        ]);
    }
}