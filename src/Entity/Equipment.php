<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0', nullable: true)]
    private ?string $extra_cost = null;

    #[ORM\ManyToOne(inversedBy: 'equipment')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gite $gite = null;

    #[ORM\ManyToMany(targetEntity: Feature::class, inversedBy: 'equipment')]
    private Collection $features;

    public function __construct()
    {
        
        $this->features = new ArrayCollection();
    }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getExtraCost(): ?string
    {
        return $this->extra_cost;
    }

    public function setExtraCost(?string $extra_cost): static
    {
        $this->extra_cost = $extra_cost;

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

  
    public function addFeature(Feature $feature): static
    {
        if (!$this->features->contains($feature)) {
            $this->features->add($feature);
        }

        return $this;
    }

    public function removeFeature(Feature $feature): static
    {
        $this->features->removeElement($feature);

        return $this;
    }

    /**
     * @return Collection<int, Feature>
     */
    public function getFeatures(): Collection
    {
        return $this->features;
    }
}
