<?php

namespace App\Entity;

use App\Repository\CompteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteurRepository::class)
 */
class Compteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entite;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroActuel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntite(): ?string
    {
        return $this->entite;
    }

    public function setEntite(string $entite): self
    {
        $this->entite = $entite;

        return $this;
    }

    public function getNumeroActuel(): ?int
    {
        return $this->numeroActuel;
    }

    public function setNumeroActuel(int $numeroActuel): self
    {
        $this->numeroActuel = $numeroActuel;

        return $this;
    }
}
