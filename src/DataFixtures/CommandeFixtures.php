<?php

namespace App\DataFixtures;

use App\Entity\Commande;
use App\Data\ListeCommande;
use App\Repository\ClientRepository;
use App\Repository\CommandeStatutRepository;
use App\Service\HourdinaCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommandeFixtures extends Fixture
{

    public function __construct(
        ClientRepository            $clientRepository,
        HourdinaCode                $hourdinaCode,
        CommandeStatutRepository    $commandeStatutRepository
    ){
        $this->clientRepository = $clientRepository;
        $this->hourdinaCode = $hourdinaCode;
        $this->commandeStatutRepository = $commandeStatutRepository;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (ListeCommande::$mesCommandes as $macommande)
        {
            $commande = new Commande();
            $commande->setMontantHT($macommande['montantHT']);
            $commande->setClient($this->clientRepository->findOneByCode($macommande['client']));
            $commande->setStatut($this->commandeStatutRepository->find($macommande['statut']));
            $commande->setCode($this->hourdinaCode->getNewCode('commande',$commande));
            $manager->persist($commande);
        }
        $manager->flush();
    }
}
