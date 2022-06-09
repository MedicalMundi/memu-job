<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpApi;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiAdminController extends AbstractController
{
    /**
     * @route("/api-backoffice", name="backoffice_api_home")
     */
    public function __invoke(): Response
    {
        return $this->json([
            'message' => 'Api backoffice admin controller',
        ]);
    }
}
