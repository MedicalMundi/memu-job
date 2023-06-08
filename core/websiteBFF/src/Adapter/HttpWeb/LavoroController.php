<?php declare(strict_types=1);

namespace WebSiteBFF\Adapter\HttpWeb;

use Publishing\Cms\Application\Usecase\LastConcorsi;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LavoroController extends AbstractController
{
    private LastConcorsi $lastConcorsi;

    public function __construct(LastConcorsi $lastConcorsi)
    {
        $this->lastConcorsi = $lastConcorsi;
    }

    /**
     * @Route("/lavoro", name="website_lavoro")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        $data = $this->lastConcorsi->lastConcorsi();

        return $this->render('@website/lavoro/index.html.twig', [
            'data' => $data,
        ]);
    }
}
