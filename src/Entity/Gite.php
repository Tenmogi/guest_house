<?php

namespace App\Entity;

use App\Repository\GiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GiteRepository::class)]
class Gite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\ManyToOne]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?Owner $Owner = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $department = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8, nullable: true)]
    private ?string $latitude = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 11, scale: 8, nullable: true)]
    private ?string $longitude = null;

    #[ORM\Column]
    private ?int $hab_surface = null;

    #[ORM\Column]
    private ?int $no_bedrooms = null;

    #[ORM\Column]
    private ?int $no_beds = null;

    #[ORM\Column]
    private ?bool $pet_friendly = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0', nullable: true)]
    private ?string $pet_fee = null;

    #[ORM\ManyToOne(inversedBy: 'gites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Owner $owner = null;

    

    #[ORM\OneToMany(mappedBy: 'gite', targetEntity: WeeklyRate::class)]
    private Collection $weeklyRates;

   

    // #[ORM\OneToMany(mappedBy: 'gite', targetEntity: Equipment::class)]
    // private Collection $Equipment;

    #[ORM\OneToMany(mappedBy: 'gite', targetEntity: Equipment::class)]
    private Collection $equipment;

    #[ORM\OneToMany(mappedBy: 'gite', targetEntity: Service::class)]
    private Collection $services;

    // #[ORM\OneToMany(mappedBy: 'gite', targetEntity: Service::class)]
    // private Collection $Service;

    public function __construct()
    {
        
        
        $this->weeklyRates = new ArrayCollection();
       
        // $this->Equipment = new ArrayCollection();
        $this->equipment = new ArrayCollection();
        $this->services = new ArrayCollection();
        // $this->Service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $Owner): static
    {
        $this->owner = $Owner;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): static
    {
        $this->department = $department;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getHabSurface(): ?int
    {
        return $this->hab_surface;
    }

    public function setHabSurface(int $hab_surface): static
    {
        $this->hab_surface = $hab_surface;

        return $this;
    }

    public function getNoBedrooms(): ?int
    {
        return $this->no_bedrooms;
    }

    public function setNoBedrooms(int $no_bedrooms): static
    {
        $this->no_bedrooms = $no_bedrooms;

        return $this;
    }

    public function getNoBeds(): ?int
    {
        return $this->no_beds;
    }

    public function setNoBeds(int $no_beds): static
    {
        $this->no_beds = $no_beds;

        return $this;
    }

    public function isPetFriendly(): ?bool
    {
        return $this->pet_friendly;
    }

    public function setPetFriendly(bool $pet_friendly): static
    {
        $this->pet_friendly = $pet_friendly;

        return $this;
    }

    public function getPetFee(): ?string
    {
        return $this->pet_fee;
    }

    public function setPetFee(?string $pet_fee): static
    {
        $this->pet_fee = $pet_fee;

        return $this;
    }

    /**
     * @return Collection<int, WeeklyRate>
     */
    public function getWeeklyRates(): Collection
    {
        return $this->weeklyRates;
    }

    public function addWeeklyRate(WeeklyRate $weeklyRate): static
    {
        if (!$this->weeklyRates->contains($weeklyRate)) {
            $this->weeklyRates->add($weeklyRate);
            $weeklyRate->setGite($this);
        }

        return $this;
    }

    public function removeWeeklyRate(WeeklyRate $weeklyRate): static
    {
        if ($this->weeklyRates->removeElement($weeklyRate)) {
            // set the owning side to null (unless already changed)
            if ($weeklyRate->getGite() === $this) {
                $weeklyRate->setGite(null);
            }
        }

        return $this;
    }

  
    /**
     * @return Collection<int, Equipment>
     */
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(Equipment $equipment): static
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment->add($equipment);
            $equipment->setGite($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): static
    {
        if ($this->equipment->removeElement($equipment)) {
            // set the owning side to null (unless already changed)
            if ($equipment->getGite() === $this) {
                $equipment->setGite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->setGite($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getGite() === $this) {
                $service->setGite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getService(): Collection
    {
        return $this->services;
    }
}
