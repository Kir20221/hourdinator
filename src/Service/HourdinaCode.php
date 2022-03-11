<?php

namespace App\Service;

use App\Entity\Compteur;
use App\Repository\CompteurRepository;
use Doctrine\ORM\EntityManagerInterface;

class HourdinaCode
{

    private $code;

    public function __construct(
        CompteurRepository  $compteurRepository,
        EntityManagerInterface  $em
    ){
        $this->compteurRepository = $compteurRepository;
        $this->em = $em;
    }

    public function getNewCode($typeentite, $entite)
    {

        $compteur = $this->getCompteur($typeentite);

        $compteur->setNumeroActuel($compteur->getNumeroActuel()+1);

        if($typeentite=='client'){
            $numero = substr('00000' . $compteur->getNumeroActuel(),-5);
            $this->code = 'CLT' . $entite->getCategorie()->getCode() . $numero;
        }

        if($typeentite=='article'){
            $numero = substr('00000' . $compteur->getNumeroActuel(),-5);
            $this->code = 'ART' . $entite->getCategorie()->getCode() . $numero;
        }

        if($typeentite=='commande'){
            $numero = substr('00000' . $compteur->getNumeroActuel(),-5);
            $this->code = 'COM' . $numero;
        }

        return $this->code;
    }

    public function getCompteur($typeentite){
        $compteur = $this->compteurRepository->findOneByEntite($typeentite);
        if(is_null($compteur)){
            $compteur = new Compteur();
            $compteur->setEntite($typeentite);
            $compteur->setNumeroActuel(0);
            $this->em->persist($compteur);
        }
        return $compteur;
    }

}