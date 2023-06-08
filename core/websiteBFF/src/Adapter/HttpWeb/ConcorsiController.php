<?php declare(strict_types=1);

namespace WebSiteBFF\Adapter\HttpWeb;

use Publishing\Cms\Application\Usecase\LastConcorsi;
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
     * @Route("/concorsi", name="website_concorsi")
     */
    public function index(): Response
    {
        $data = $this->lastConcorsi->lastConcorsi();

        return $this->render('@website/concorsi/index.html.twig', [
            'data' => $data,
        ]);
    }
}
