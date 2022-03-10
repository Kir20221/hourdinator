<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ClientCategorieRepository;

class ArticleService
{

    public function __construct(
        ClientCategorieRepository   $clientCategorieRepository,
        HourdinaCode                $hourdinaCode
    ){
        $this->clientCategorieRepository = $clientCategorieRepository;
        $this->hourdinaCode = $hourdinaCode;
    }

    public function setArticle(
        Article $article
    )
    {
        if(is_null($article->getCode())){
            $article->setCode($this->hourdinaCode->getNewCode('article',$article));

        }
        if(is_null($article->getPrix())){
            $article->setPrix($article->getCategorie()->getPrixDefaut());
        }
    }

    public function newArticle(
    )
    {
        $article = new Article();
        $categories = $this->clientCategorieRepository->findAll();
        foreach($categories as $categ){
            $article->addAchetablePar($categ);
        }

        return $article;
    }
}