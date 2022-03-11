<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{

    public function __construct()
    {
        $this->montantHT = 0;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateLivrReelle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateLivrEstimee;

    /**
     * @ORM\Column(type="float")
     */
    private $montantHT;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=CommandeStatut::class, inversedBy="commandes")
     */
    private $statut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDateLivrReelle(): ?\DateTimeInterface
    {
        return $this->dateLivrReelle;
    }

    public function setDateLivrReelle(?\DateTimeInterface $dateLivrReelle): self
    {
        $this->dateLivrReelle = $dateLivrReelle;

        return $this;
    }

    public function getDateLivrEstimee(): ?\DateTimeInterface
    {
        return $this->dateLivrEstimee;
    }

    public function setDateLivrEstimee(?\DateTimeInterface $dateLivrEstimee): self
    {
        $this->dateLivrEstimee = $dateLivrEstimee;

        return $this;
    }

    public function getMontantHT(): ?float
    {
        return $this->montantHT;
    }

    public function setMontantHT(float $montantHT): self
    {
        $this->montantHT = $montantHT;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getStatut(): ?CommandeStatut
    {
        return $this->statut;
    }

    public function setStatut(?CommandeStatut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }
}
