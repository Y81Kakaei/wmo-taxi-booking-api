<?php

namespace App\DataFixtures;

use App\Entity\AnnualSubsidyBudget;
use App\Entity\Passenger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnnualSubsidyBudgetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $passengers = $this->getPassengers();

        foreach ($passengers as $passenger) {
            $subsidy = new AnnualSubsidyBudget();
            $subsidy->setBudgetInKm(rand(400, 1000));
            $subsidy->setPassenger($passenger);
            $manager->persist($subsidy);

            $passenger->setLeftBudgetInKm($subsidy->getBudgetInKm());
            $manager->persist($passenger);
        }

        $manager->flush();
    }

    /**
     * @param string $name
     */
    public function getPassenger($name, ?string $class = null): Passenger
    {
        /** @var Passenger $passenger */
        $passenger = parent::getReference($name, $class);

        return $passenger;
    }

    public function getDependencies(): array
    {
        return [
            PassengerFixtures::class,
        ];
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
}
