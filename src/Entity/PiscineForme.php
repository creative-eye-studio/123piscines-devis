<?php

namespace App\Entity;

use App\Repository\PiscineFormeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiscineFormeRepository::class)]
class PiscineForme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $btn_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $btn_link = null;

    #[ORM\OneToMany(mappedBy: 'forme', targetEntity: PiscineListe::class)]
    private Collection $piscineListes;

    public function __construct()
    {
        $this->piscineListes = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getBtnName(): ?string
    {
        return $this->btn_name;
    }

    public function setBtnName(?string $btn_name): static
    {
        $this->btn_name = $btn_name;

        return $this;
    }

    public function getBtnLink(): ?string
    {
        return $this->btn_link;
    }

    public function setBtnLink(?string $btn_link): static
    {
        $this->btn_link = $btn_link;

        return $this;
    }

    /**
     * @return Collection<int, PiscineListe>
     */
    public function getPiscineListes(): Collection
    {
        return $this->piscineListes;
    }

    public function addPiscineListe(PiscineListe $piscineListe): static
    {
        if (!$this->piscineListes->contains($piscineListe)) {
            $this->piscineListes->add($piscineListe);
            $piscineListe->setForme($this);
        }

        return $this;
    }

    public function removePiscineListe(PiscineListe $piscineListe): static
    {
        if ($this->piscineListes->removeElement($piscineListe)) {
            // set the owning side to null (unless already changed)
            if ($piscineListe->getForme() === $this) {
                $piscineListe->setForme(null);
            }
        }

        return $this;
    }
}
