<?php

namespace App\Entity;

use App\Repository\PiscineListeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiscineListeRepository::class)]
class PiscineListe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'piscineListes')]
    private ?PiscineForme $forme = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'piscine', targetEntity: PiscineTailles::class)]
    private Collection $piscineTailles;

    #[ORM\OneToMany(mappedBy: 'piscine', targetEntity: PiscineEsc::class)]
    private Collection $piscineEscs;

    public function __construct()
    {
        $this->piscineTailles = new ArrayCollection();
        $this->piscineEscs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getForme(): ?PiscineForme
    {
        return $this->forme;
    }

    public function setForme(?PiscineForme $forme): static
    {
        $this->forme = $forme;

        return $this;
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

    /**
     * @return Collection<int, PiscineTailles>
     */
    public function getPiscineTailles(): Collection
    {
        return $this->piscineTailles;
    }

    public function addPiscineTaille(PiscineTailles $piscineTaille): static
    {
        if (!$this->piscineTailles->contains($piscineTaille)) {
            $this->piscineTailles->add($piscineTaille);
            $piscineTaille->setPiscine($this);
        }

        return $this;
    }

    public function removePiscineTaille(PiscineTailles $piscineTaille): static
    {
        if ($this->piscineTailles->removeElement($piscineTaille)) {
            // set the owning side to null (unless already changed)
            if ($piscineTaille->getPiscine() === $this) {
                $piscineTaille->setPiscine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PiscineEsc>
     */
    public function getPiscineEscs(): Collection
    {
        return $this->piscineEscs;
    }

    public function addPiscineEsc(PiscineEsc $piscineEsc): static
    {
        if (!$this->piscineEscs->contains($piscineEsc)) {
            $this->piscineEscs->add($piscineEsc);
            $piscineEsc->setPiscine($this);
        }

        return $this;
    }

    public function removePiscineEsc(PiscineEsc $piscineEsc): static
    {
        if ($this->piscineEscs->removeElement($piscineEsc)) {
            // set the owning side to null (unless already changed)
            if ($piscineEsc->getPiscine() === $this) {
                $piscineEsc->setPiscine(null);
            }
        }

        return $this;
    }
}
