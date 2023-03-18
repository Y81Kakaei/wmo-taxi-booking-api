<?php

namespace App\Entity;

use App\Repository\ResidentRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResidentRepository::class)]
class Resident
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(length: 255)]
    private string $address;

    #[ORM\Column(length: 255)]
    private string $city;

    #[ORM\Column]
    private bool $isSubsidized;

    #[ORM\Column]
    private float $leftBudgetInKm;

    #[ORM\Column]
    private DateTimeImmutable $registrationDate;

    #[ORM\ManyToOne(inversedBy: 'residents')]
    #[ORM\JoinColumn(nullable: false)]
    private Area $area;

    #[ORM\OneToOne(mappedBy: 'resident', cascade: ['persist', 'remove'])]
    private AnnualSubsidyBudget $annualSubsidyBudget;

    #[ORM\OneToMany(mappedBy: 'resident', targetEntity: Journey::class, orphanRemoval: true)]
    private Collection $journeys;

    public function __construct()
    {
        $this->journeys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function isIsSubsidized(): bool
    {
        return $this->isSubsidized;
    }

    public function setIsSubsidized(bool $isSubsidized): self
    {
        $this->isSubsidized = $isSubsidized;

        return $this;
    }

    public function getLeftBudgetInKm(): float
    {
        return $this->leftBudgetInKm;
    }

    public function setLeftBudgetInKm(float $leftBudgetInKm): self
    {
        $this->leftBudgetInKm = $leftBudgetInKm;

        return $this;
    }

    public function getRegistrationDate(): DateTimeImmutable
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(DateTimeImmutable $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    public function getArea(): Area
    {
        return $this->area;
    }

    public function setArea(Area $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getAnnualSubsidyBudget(): AnnualSubsidyBudget
    {
        return $this->annualSubsidyBudget;
    }

    public function setAnnualSubsidyBudget(AnnualSubsidyBudget $annualSubsidyBudget): self
    {
        if ($annualSubsidyBudget->getResident() !== $this) {
            $annualSubsidyBudget->setResident($this);
        }

        $this->annualSubsidyBudget = $annualSubsidyBudget;

        return $this;
    }

    /**
     * @return Collection<int, Journey>
     */
    public function getJourneys(): Collection
    {
        return $this->journeys;
    }

    public function addJourney(Journey $journey): self
    {
        if (!$this->journeys->contains($journey)) {
            $this->journeys->add($journey);
            $journey->setResident($this);
        }

        return $this;
    }

    public function removeJourney(Journey $journey): self
    {
        if ($this->journeys->removeElement($journey)) {
            if ($journey->getResident() === $this) {
                $journey->setResident(null);
            }
        }

        return $this;
    }
}
