<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=ArticleCategorie::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity=ClientCategorie::class, inversedBy="articles")
     */
    private $achetablePar;

    public function __construct()
    {
        $this->achetablePar = new ArrayCollection();
    }

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

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategorie(): ?ArticleCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?ArticleCategorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, ClientCategorie>
     */
    public function getAchetablePar(): Collection
    {
        return $this->achetablePar;
    }

    public function addAchetablePar(ClientCategorie $achetablePar): self
    {
        if (!$this->achetablePar->contains($achetablePar)) {
            $this->achetablePar[] = $achetablePar;
        }

        return $this;
    }

    public function removeAchetablePar(ClientCategorie $achetablePar): self
    {
        $this->achetablePar->removeElement($achetablePar);

        return $this;
    }
}
