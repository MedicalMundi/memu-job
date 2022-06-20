<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb\Publishing;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/publishing")
 * @IsGranted("ROLE_ADMIN")
 */
class PublishingController extends AbstractController
{
    /**
     * @Route("/", name="backoffice_publishing", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('@backoffice/publishing/index.html.twig', [

        ]);
    }
}
