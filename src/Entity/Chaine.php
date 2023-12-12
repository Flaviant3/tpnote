<?php

namespace App\Entity;

use App\Repository\ChaineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChaineRepository::class)]
class Chaine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $diffuseur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDiffuseur(): ?string
    {
        return $this->diffuseur;
    }

    public function setDiffuseur(string $diffuseur): static
    {
        $this->diffuseur = $diffuseur;

        return $this;
    }
}
