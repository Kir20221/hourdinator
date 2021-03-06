<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard")
     */
    public function index(
        ClientRepository $clientRepository

    ): Response
    {
        $statsClients=$clientRepository->getStatsCommandes();
        return $this->render('dashboard/index.html.twig', [
            'statsClients' => $statsClients,
        ]);
    }
}
