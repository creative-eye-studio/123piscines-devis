<?php

namespace App\Entity;

use App\Repository\PiscineTaillesRepository;
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
}
