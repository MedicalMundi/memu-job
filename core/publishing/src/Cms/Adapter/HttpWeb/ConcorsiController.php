<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb;

use Publishing\Cms\Application\Usecase\LastConcorsi;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcorsiController extends AbstractController
{
    private LastConcorsi $lastConcorsi;

    public function __construct(LastConcorsi $lastConcorsi)
    {
        $this->lastConcorsi = $lastConcorsi;
    }

    /**
     * @Route("/concorsi", name="app_concorsi")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        $data = $this->lastConcorsi->lastConcorsi();

        return $this->render('@front/concorsi/index.html.twig', [
            'data' => $data,
        ]);
    }
}
