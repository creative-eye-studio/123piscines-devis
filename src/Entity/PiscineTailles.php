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

    #[ORM\Column]
    private ?bool $secu_alarme = null;

    #[ORM\Column(nullable: true)]
    private ?float $secu_alarme_prix = null;

    #[ORM\Column]
    private ?bool $secu_cover = null;

    #[ORM\Column(nullable: true)]
    private ?float $secu_cover_prix = null;

    #[ORM\Column]
    private ?bool $secu_barrier = null;

    #[ORM\Column(nullable: true)]
    private ?float $secu_barrier_prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: PiscineEsc::class)]
    private Collection $piscineEscs;

    #[ORM\Column(nullable: true)]
    private ?bool $revet_poly = null;

    #[ORM\Column(nullable: true)]
    private ?float $revet_poly_price = null;

    #[ORM\Column(nullable: true)]
    private ?bool $liner = null;

    #[ORM\Column(nullable: true)]
    private ?float $liner_price = null;

    #[ORM\OneToMany(mappedBy: 'tailles', targetEntity: Filtrations::class)]
    private Collection $filtrations;

    public function __construct()
    {
        $this->piscineEscs = new ArrayCollection();
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

    public function isSecuAlarme(): ?bool
    {
        return $this->secu_alarme;
    }

    public function setSecuAlarme(bool $secu_alarme): static
    {
        $this->secu_alarme = $secu_alarme;

        return $this;
    }

    public function getSecuAlarmePrix(): ?float
    {
        return $this->secu_alarme_prix;
    }

    public function setSecuAlarmePrix(?float $secu_alarme_prix): static
    {
        $this->secu_alarme_prix = $secu_alarme_prix;

        return $this;
    }

    public function isSecuCover(): ?bool
    {
        return $this->secu_cover;
    }

    public function setSecuCover(bool $secu_cover): static
    {
        $this->secu_cover = $secu_cover;

        return $this;
    }

    public function getSecuCoverPrix(): ?float
    {
        return $this->secu_cover_prix;
    }

    public function setSecuCoverPrix(?float $secu_cover_prix): static
    {
        $this->secu_cover_prix = $secu_cover_prix;

        return $this;
    }

    public function isSecuBarrier(): ?bool
    {
        return $this->secu_barrier;
    }

    public function setSecuBarrier(bool $secu_barrier): static
    {
        $this->secu_barrier = $secu_barrier;

        return $this;
    }

    public function getSecuBarrierPrix(): ?float
    {
        return $this->secu_barrier_prix;
    }

    public function setSecuBarrierPrix(?float $secu_barrier_prix): static
    {
        $this->secu_barrier_prix = $secu_barrier_prix;

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
            $piscineEsc->setTaille($this);
        }

        return $this;
    }

    public function removePiscineEsc(PiscineEsc $piscineEsc): static
    {
        if ($this->piscineEscs->removeElement($piscineEsc)) {
            // set the owning side to null (unless already changed)
            if ($piscineEsc->getTaille() === $this) {
                $piscineEsc->setTaille(null);
            }
        }

        return $this;
    }

    public function isRevetPoly(): ?bool
    {
        return $this->revet_poly;
    }

    public function setRevetPoly(?bool $revet_poly): static
    {
        $this->revet_poly = $revet_poly;

        return $this;
    }

    public function getRevetPolyPrice(): ?float
    {
        return $this->revet_poly_price;
    }

    public function setRevetPolyPrice(?float $revet_poly_price): static
    {
        $this->revet_poly_price = $revet_poly_price;

        return $this;
    }

    public function isLiner(): ?bool
    {
        return $this->liner;
    }

    public function setLiner(?bool $liner): static
    {
        $this->liner = $liner;

        return $this;
    }

    public function getLinerPrice(): ?float
    {
        return $this->liner_price;
    }

    public function setLinerPrice(?float $liner_price): static
    {
        $this->liner_price = $liner_price;

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
            $filtration->setTailles($this);
        }

        return $this;
    }

    public function removeFiltration(Filtrations $filtration): static
    {
        if ($this->filtrations->removeElement($filtration)) {
            // set the owning side to null (unless already changed)
            if ($filtration->getTailles() === $this) {
                $filtration->setTailles(null);
            }
        }

        return $this;
    }
}
