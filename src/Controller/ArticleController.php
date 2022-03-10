<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ClientCategorie;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\ClientCategorieRepository;
use App\Service\ArticleService;
use App\Service\HourdinaCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_article_new", methods={"GET", "POST"})
     */
    public function new(
        Request             $request,
        ArticleRepository   $articleRepository,
        ArticleService      $articleService,
        HourdinaCode        $hourdinaCode
    ): Response
    {
        $article = $articleService->newArticle();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        // je passe dans le if lorsque le fomulaire est rempli
        if ($form->isSubmitted() && $form->isValid()) {

            $articleService->setArticle($article);
        
            $articleRepository->add($article);
            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_article_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        Article $article,
        ArticleRepository $articleRepository,
        ArticleService      $articleService
    ): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $articleService->setArticle($article);

            $articleRepository->add($article);
            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_article_delete", methods={"POST"})
     */
    public function delete(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $articleRepository->remove($article);
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }
}
