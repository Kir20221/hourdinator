<?php

namespace App\Controller;

use App\Entity\ArticleCategorie;
use App\Form\ArticleCategorieType;
use App\Repository\ArticleCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article/categorie")
 */
class ArticleCategorieController extends AbstractController
{
    /**
     * @Route("/", name="app_article_categorie_index", methods={"GET"})
     */
    public function index(ArticleCategorieRepository $articleCategorieRepository): Response
    {
        return $this->render('article_categorie/index.html.twig', [
            'article_categories' => $articleCategorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_article_categorie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArticleCategorieRepository $articleCategorieRepository): Response
    {
        $articleCategorie = new ArticleCategorie();
        $form = $this->createForm(ArticleCategorieType::class, $articleCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleCategorieRepository->add($articleCategorie);
            return $this->redirectToRoute('app_article_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_categorie/new.html.twig', [
            'article_categorie' => $articleCategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_article_categorie_show", methods={"GET"})
     */
    public function show(ArticleCategorie $articleCategorie): Response
    {
        return $this->render('article_categorie/show.html.twig', [
            'article_categorie' => $articleCategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_article_categorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ArticleCategorie $articleCategorie, ArticleCategorieRepository $articleCategorieRepository): Response
    {
        $form = $this->createForm(ArticleCategorieType::class, $articleCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleCategorieRepository->add($articleCategorie);
            return $this->redirectToRoute('app_article_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_categorie/edit.html.twig', [
            'article_categorie' => $articleCategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_article_categorie_delete", methods={"POST"})
     */
    public function delete(Request $request, ArticleCategorie $articleCategorie, ArticleCategorieRepository $articleCategorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleCategorie->getId(), $request->request->get('_token'))) {
            $articleCategorieRepository->remove($articleCategorie);
        }

        return $this->redirectToRoute('app_article_categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
