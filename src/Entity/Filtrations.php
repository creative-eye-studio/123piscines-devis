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

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: PiscineTailles::class, inversedBy: 'filtrations')]
    private Collection $tailles;

    #[ORM\Column]
    private ?float $prix = null;

    public function __construct()
    {
        $this->tailles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
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

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, PiscineTailles>
     */
    public function getTailles(): Collection
    {
        return $this->tailles;
    }

    public function addTaille(PiscineTailles $taille): static
    {
        if (!$this->tailles->contains($taille)) {
            $this->tailles->add($taille);
        }

        return $this;
    }

    public function removeTaille(PiscineTailles $taille): static
    {
        $this->tailles->removeElement($taille);

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
}
