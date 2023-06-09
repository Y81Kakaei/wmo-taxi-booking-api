<?php

namespace App\DataFixtures;

use App\Entity\Journey;
use App\Entity\Passenger;
use App\Entity\TaxiCompany;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class JourneyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $passengers = $this->getPassengers();
        $taxiCompanies = $this->getTaxiCompanies();
        $chunkPassengers = array_chunk($passengers, ceil(count($passengers) / count($taxiCompanies)));

        /**
         * @var int $i
         * @var Passenger[] $passengers
        */
        foreach ($chunkPassengers as $i => $passengers) {
            $taxiCompany = $taxiCompanies[$i];
            foreach ($passengers as $passenger) {
                $journey = $this->createJourney($passenger, $taxiCompany);

                $passenger->setLeftBudgetInKm($passenger->getLeftBudgetInKm() - $journey->getDistanceInKm());

                $manager->persist($journey);
                $manager->persist($passenger);
            }
        }

        $manager->flush();
    }

    public function getTaxiCompany(string $name): TaxiCompany
    {
        /** @var TaxiCompany $taxiCompany */
        $taxiCompany = parent::getReference($name);

        return $taxiCompany;
    }

    public function getPassenger(string $name): Passenger
    {
        /** @var Passenger $passenger */
        $passenger = parent::getReference($name);

        return $passenger;
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            PassengerFixtures::class,
            TaxiCompanyFixtures::class,
        ];
    }

    public function createJourney(Passenger $passenger, TaxiCompany $taxiCompany): Journey
    {
        $randomDateTime = $this->generateRandomDateTimeImmutable('-5 years', '-1 year');

        $journey = new Journey();
        $journey->setPassenger($passenger);
        $journey->setTaxiCompany($taxiCompany);
        $journey->setArrivalDateTime($randomDateTime);
        $journey->setStatus('COMPLETED');
        $journey->setDistanceInKm(rand(20, 60));
        $journey->setDropOffAddress(rand(1200, 3999) . 'AB');
        $journey->setPickUpAddress(rand(1200, 3999) . 'CD');
        $journey->setArrivalDateTime($randomDateTime);
        $journey->setPickUpDateTime($randomDateTime);

        return $journey;
    }

    private function generateRandomDateTimeImmutable(
        string $startDate = '-10 years',
        string $endDate = 'now'
    ): DateTimeImmutable {
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);
        $randomTimestamp = rand($startTimestamp, $endTimestamp);

        return new DateTimeImmutable('@' . $randomTimestamp);
    }

    /**
     * @return Passenger[]
     */
    public function getPassengers(): array
    {
        return [
            $this->getPassenger(PassengerFixtures::PASSENGER_JOHN),
            $this->getPassenger(PassengerFixtures::PASSENGER_TIM),
            $this->getPassenger(PassengerFixtures::PASSENGER_JANE),
            $this->getPassenger(PassengerFixtures::PASSENGER_MARRY),
            $this->getPassenger(PassengerFixtures::PASSENGER_CATHY),
        ];
    }

    /**
     * @return TaxiCompany[]
     */
    public function getTaxiCompanies(): array
    {
        return [
            $this->getTaxiCompany(TaxiCompanyFixtures::TAXI_UTRECHT),
            $this->getTaxiCompany(TaxiCompanyFixtures::TAXI_AMSTERDAM),
        ];
    }
}
