<?php

namespace App\Entity;

use App\Repository\GlobalSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlobalSettingsRepository::class)]
class GlobalSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = 0;

    #[ORM\Column(nullable: true)]
    private ?float $damping = 0;

    #[ORM\Column(nullable: true)]
    private ?float $scrollimg = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDamping(): ?float
    {
        return $this->damping;
    }

    public function setDamping(?float $damping): self
    {
        $this->damping = $damping;

        return $this;
    }

    public function getScrollimg(): ?float
    {
        return $this->scrollimg;
    }

    public function setScrollimg(?float $scrollimg): self
    {
        $this->scrollimg = $scrollimg;

        return $this;
    }
}
