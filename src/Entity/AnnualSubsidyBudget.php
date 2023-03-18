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
    private Resident $resident;

    #[ORM\Column]
    private float $budgetInKm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResident(): Resident
    {
        return $this->resident;
    }

    public function setResident(Resident $resident): self
    {
        $this->resident = $resident;

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
