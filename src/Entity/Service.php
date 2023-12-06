<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0', nullable: true)]
    private ?string $additional_cost = null;

    #[ORM\ManyToOne(inversedBy: 'services')]
    private ?Gite $gite = null;

    // #[ORM\ManyToOne(inversedBy: 'Service')]
    // private ?Gite $gite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAdditionalCost(): ?string
    {
        return $this->additional_cost;
    }

    public function setAdditionalCost(?string $additional_cost): static
    {
        $this->additional_cost = $additional_cost;

        return $this;
    }

    public function getGite(): ?Gite
    {
        return $this->gite;
    }

    public function setGite(?Gite $gite): static
    {
        $this->gite = $gite;

        return $this;
    }
}
