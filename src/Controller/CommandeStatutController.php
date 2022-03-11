<?php

namespace App\Controller;

use App\Entity\CommandeStatut;
use App\Form\CommandeStatutType;
use App\Repository\CommandeStatutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commandestatut")
 */
class CommandeStatutController extends AbstractController
{
    /**
     * @Route("/", name="app_commande_statut_index", methods={"GET"})
     */
    public function index(CommandeStatutRepository $commandeStatutRepository): Response
    {
        return $this->render('commande_statut/index.html.twig', [
            'commande_statuts' => $commandeStatutRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_commande_statut_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CommandeStatutRepository $commandeStatutRepository): Response
    {
        $commandeStatut = new CommandeStatut();
        $form = $this->createForm(CommandeStatutType::class, $commandeStatut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandeStatutRepository->add($commandeStatut);
            return $this->redirectToRoute('app_commande_statut_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande_statut/new.html.twig', [
            'commande_statut' => $commandeStatut,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_commande_statut_show", methods={"GET"})
     */
    public function show(CommandeStatut $commandeStatut): Response
    {
        return $this->render('commande_statut/show.html.twig', [
            'commande_statut' => $commandeStatut,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_commande_statut_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CommandeStatut $commandeStatut, CommandeStatutRepository $commandeStatutRepository): Response
    {
        $form = $this->createForm(CommandeStatutType::class, $commandeStatut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandeStatutRepository->add($commandeStatut);
            return $this->redirectToRoute('app_commande_statut_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande_statut/edit.html.twig', [
            'commande_statut' => $commandeStatut,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_commande_statut_delete", methods={"POST"})
     */
    public function delete(Request $request, CommandeStatut $commandeStatut, CommandeStatutRepository $commandeStatutRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeStatut->getId(), $request->request->get('_token'))) {
            $commandeStatutRepository->remove($commandeStatut);
        }

        return $this->redirectToRoute('app_commande_statut_index', [], Response::HTTP_SEE_OTHER);
    }
}
