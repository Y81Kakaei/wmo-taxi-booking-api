<?php

namespace App\DataFixtures;

use App\Entity\Journey;
use App\Entity\Resident;
use App\Entity\TaxiCompany;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class JourneyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $residents = $this->getResidents();
        $taxiCompanies = $this->getTaxiCompanies();
        $chunkPassengers = array_chunk($residents, ceil(count($residents) / count($taxiCompanies)));

        /**
         * @var int $i
         * @var Resident[] $passengers
        */
        foreach ($chunkPassengers as $i => $passengers) {
            $taxiCompany = $taxiCompanies[$i];
            foreach ($passengers as $passenger) {
                $journey = $this->getJourney($passenger, $taxiCompany);

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

    public function getResident(string $name): Resident
    {
        /** @var Resident $resident */
        $resident = parent::getReference($name);

        return $resident;
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            ResidentFixtures::class,
            TaxiCompanyFixtures::class,
        ];
    }

    public function getJourney(Resident $passenger, TaxiCompany $taxiCompany): Journey
    {
        $randomDateTime = $this->generateRandomDateTimeImmutable('-5 years', '-1 year');

        $journey = new Journey();
        $journey->setResident($passenger);
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
     * @return Resident[]
     */
    public function getResidents(): array
    {
        return [
            $this->getResident(ResidentFixtures::RESIDENT_JOHN),
            $this->getResident(ResidentFixtures::RESIDENT_TIM),
            $this->getResident(ResidentFixtures::RESIDENT_JANE),
            $this->getResident(ResidentFixtures::RESIDENT_MARRY),
            $this->getResident(ResidentFixtures::RESIDENT_CATHY),
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
