<?php

namespace App\Entity;

use App\Repository\JourneyRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JourneyRepository::class)]
class Journey
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'journeys')]
    #[ORM\JoinColumn(nullable: false)]
    private Passenger $passenger;

    #[ORM\ManyToOne(inversedBy: 'journeys')]
    #[ORM\JoinColumn(nullable: false)]
    private TaxiCompany $taxiCompany;

    #[ORM\Column(length: 255)]
    private string $pickUpAddress;

    #[ORM\Column(length: 255)]
    private string $dropOffAddress;

    #[ORM\Column]
    private float $distanceInKm;

    #[ORM\Column]
    private DateTimeImmutable $pickUpDateTime;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $arrivalDateTime = null;

    #[ORM\Column(length: 255)]
    private string $status;

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

    public function getTaxiCompany(): TaxiCompany
    {
        return $this->taxiCompany;
    }

    public function setTaxiCompany(TaxiCompany $taxiCompany): self
    {
        $this->taxiCompany = $taxiCompany;

        return $this;
    }

    public function getPickUpAddress(): string
    {
        return $this->pickUpAddress;
    }

    public function setPickUpAddress(string $pickUpAddress): self
    {
        $this->pickUpAddress = $pickUpAddress;

        return $this;
    }

    public function getDropOffAddress(): string
    {
        return $this->dropOffAddress;
    }

    public function setDropOffAddress(string $dropOffAddress): self
    {
        $this->dropOffAddress = $dropOffAddress;

        return $this;
    }

    public function getDistanceInKm(): float
    {
        return $this->distanceInKm;
    }

    public function setDistanceInKm(float $distanceInKm): self
    {
        $this->distanceInKm = $distanceInKm;

        return $this;
    }

    public function getPickUpDateTime(): DateTimeImmutable
    {
        return $this->pickUpDateTime;
    }

    public function setPickUpDateTime(DateTimeImmutable $pickUpDateTime): self
    {
        $this->pickUpDateTime = $pickUpDateTime;

        return $this;
    }

    public function getArrivalDateTime(): ?DateTimeImmutable
    {
        return $this->arrivalDateTime;
    }

    public function setArrivalDateTime(?DateTimeImmutable $arrivalDateTime): self
    {
        $this->arrivalDateTime = $arrivalDateTime;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
