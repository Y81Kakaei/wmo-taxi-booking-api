<?php

namespace App\Entity;

use App\Repository\AnnualSubsidyBudgetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnualSubsidyBudgetRepository::class)]
class AnnualSubsidyBudget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'annualSubsidyBudget', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Passenger $passenger;

    #[ORM\Column]
    private float $budgetInKm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassenger(): Passenger
    {
        return $this->passenger;
    }

    public function setPassenger(Passenger $passenger): self
    {
        $this->passenger = $passenger;

        return $this;
    }

    public function getBudgetInKm(): float
    {
        return $this->budgetInKm;
    }

    public function setBudgetInKm(float $budgetInKm): self
    {
        $this->budgetInKm = $budgetInKm;

        return $this;
    }
}
