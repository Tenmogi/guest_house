<?php

namespace App\Entity;

use App\Repository\WeeklyRateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeeklyRateRepository::class)]
class WeeklyRate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $period = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $rate = null;

    #[ORM\ManyToOne(inversedBy: 'weeklyRates')]
    private ?Gite $gite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriod(): ?string
    {
        return $this->period;
    }

    public function setPeriod(string $period): static
    {
        $this->period = $period;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(string $rate): static
    {
        $this->rate = $rate;

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
