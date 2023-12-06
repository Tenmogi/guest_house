<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OwnerRepository::class)]
class Owner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avail_hours = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Gite::class)]
    private Collection $gites;

    public function __construct()
    {
        $this->gites = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAvailHours(): ?string
    {
        return $this->avail_hours;
    }

    public function setAvailHours(?string $avail_hours): static
    {
        $this->avail_hours = $avail_hours;

        return $this;
    }

    /**
     * @return Collection<int, Gite>
     */
    public function getGites(): Collection
    {
        return $this->gites;
    }

    public function addGite(Gite $gite): static
    {
        if (!$this->gites->contains($gite)) {
            $this->gites->add($gite);
            $gite->setOwner($this);
        }

        return $this;
    }

    public function removeGite(Gite $gite): static
    {
        if ($this->gites->removeElement($gite)) {
            // set the owning side to null (unless already changed)
            if ($gite->getOwner() === $this) {
                $gite->setOwner(null);
            }
        }

        return $this;
    }
}
