<?php

namespace App\Entity;

use App\Repository\FiltrationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FiltrationsRepository::class)]
class Filtrations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'filtrations')]
    private ?PiscineListe $nom = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'filtrations')]
    private ?PiscineTailles $tailles = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?PiscineListe
    {
        return $this->nom;
    }

    public function setNom(?PiscineListe $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTailles(): ?PiscineTailles
    {
        return $this->tailles;
    }

    public function setTailles(?PiscineTailles $tailles): static
    {
        $this->tailles = $tailles;

        return $this;
    }
}
