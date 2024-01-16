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
}
