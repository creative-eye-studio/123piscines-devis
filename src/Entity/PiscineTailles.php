<?php

namespace App\Entity;

use App\Repository\PiscineTaillesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiscineTaillesRepository::class)]
class PiscineTailles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'piscineTailles')]
    private ?PiscineListe $piscine = null;

    #[ORM\Column(length: 255)]
    private ?string $taille = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\ManyToMany(targetEntity: Filtrations::class, mappedBy: 'tailles')]
    private Collection $filtrations;

    public function __construct()
    {
        $this->filtrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPiscine(): ?PiscineListe
    {
        return $this->piscine;
    }

    public function setPiscine(?PiscineListe $piscine): static
    {
        $this->piscine = $piscine;

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

    /**
     * @return Collection<int, Filtrations>
     */
    public function getFiltrations(): Collection
    {
        return $this->filtrations;
    }

    public function addFiltration(Filtrations $filtration): static
    {
        if (!$this->filtrations->contains($filtration)) {
            $this->filtrations->add($filtration);
            $filtration->addTaille($this);
        }

        return $this;
    }

    public function removeFiltration(Filtrations $filtration): static
    {
        if ($this->filtrations->removeElement($filtration)) {
            $filtration->removeTaille($this);
        }

        return $this;
    }
}
