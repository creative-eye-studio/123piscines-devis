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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'piscine', targetEntity: PiscineTailles::class)]
    private Collection $piscineTailles;

    #[ORM\OneToMany(mappedBy: 'piscine', targetEntity: PiscineColors::class)]
    private Collection $piscineColors;

    #[ORM\OneToMany(mappedBy: 'nom', targetEntity: Filtrations::class)]
    private Collection $filtrations;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageFond = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_eau = null;

    public function __construct()
    {
        $this->piscineTailles = new ArrayCollection();
        $this->piscineColors = new ArrayCollection();
        $this->filtrations = new ArrayCollection();
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
     * @return Collection<int, PiscineColors>
     */
    public function getPiscineColors(): Collection
    {
        return $this->piscineColors;
    }

    public function addPiscineColor(PiscineColors $piscineColor): static
    {
        if (!$this->piscineColors->contains($piscineColor)) {
            $this->piscineColors->add($piscineColor);
            $piscineColor->setPiscine($this);
        }

        return $this;
    }

    public function removePiscineColor(PiscineColors $piscineColor): static
    {
        if ($this->piscineColors->removeElement($piscineColor)) {
            // set the owning side to null (unless already changed)
            if ($piscineColor->getPiscine() === $this) {
                $piscineColor->setPiscine(null);
            }
        }

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
            $filtration->setNom($this);
        }

        return $this;
    }

    public function removeFiltration(Filtrations $filtration): static
    {
        if ($this->filtrations->removeElement($filtration)) {
            // set the owning side to null (unless already changed)
            if ($filtration->getNom() === $this) {
                $filtration->setNom(null);
            }
        }

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

    public function getImageFond(): ?string
    {
        return $this->imageFond;
    }

    public function setImageFond(?string $imageFond): static
    {
        $this->imageFond = $imageFond;

        return $this;
    }

    public function getImageEau(): ?string
    {
        return $this->image_eau;
    }

    public function setImageEau(?string $image_eau): static
    {
        $this->image_eau = $image_eau;

        return $this;
    }
}
