<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Area;
use App\Entity\Passenger;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PassengerFixtures extends Fixture implements DependentFixtureInterface
{
    public const PASSENGER_JOHN = 'passenger_john';
    public const PASSENGER_TIM = 'passenger_tim';
    public const PASSENGER_JANE = 'passenger_jane';
    public const PASSENGER_CATHY = 'passenger_cathy';
    public const PASSENGER_MARRY = 'passenger_marry';

    public function load(ObjectManager $manager): void
    {
        /** @var Area $utrechtArea */
        $utrechtArea = $this->getReference(AreaFixtures::AREA_UTRECHT);
        /** @var Area $amsterdamArea */
        $amsterdamArea = $this->getReference(AreaFixtures::AREA_AMSTERDAM);

        $passengerJohn = new Passenger();
        $passengerJohn->setName('John');
        $passengerJohn->setAddress('Street1 11, 12345FG');
        $passengerJohn->setArea($utrechtArea);
        $passengerJohn->setCity('Utrecht');
        $passengerJohn->setIsSubsidized(true);
        $passengerJohn->setLeftBudgetInKm(0);
        $passengerJohn->setRegistrationDate(new DateTimeImmutable('2022-01-01'));
        $manager->persist($passengerJohn);

        $passengerTim = new Passenger();
        $passengerTim->setName('Tim');
        $passengerTim->setAddress('Street2 22, 12345HI');
        $passengerTim->setArea($utrechtArea);
        $passengerTim->setCity('Utrecht');
        $passengerTim->setIsSubsidized(true);
        $passengerTim->setLeftBudgetInKm(0);
        $passengerTim->setRegistrationDate(new DateTimeImmutable('2022-02-01'));
        $manager->persist($passengerTim);

        $passengerJane = new Passenger();
        $passengerJane->setName('Jane');
        $passengerJane->setAddress('Street3 33, 12345JK');
        $passengerJane->setArea($amsterdamArea);
        $passengerJane->setCity('Amsterdam');
        $passengerJane->setIsSubsidized(true);
        $passengerJane->setLeftBudgetInKm(0);
        $passengerJane->setRegistrationDate(new DateTimeImmutable('2022-03-01'));
        $manager->persist($passengerJane);

        $passengerCathy = new Passenger();
        $passengerCathy->setName('Cathy');
        $passengerCathy->setAddress('Street4 44, 12345LM');
        $passengerCathy->setArea($amsterdamArea);
        $passengerCathy->setCity('Amsterdam');
        $passengerCathy->setIsSubsidized(true);
        $passengerCathy->setLeftBudgetInKm(0);
        $passengerCathy->setRegistrationDate(new DateTimeImmutable('2022-04-01'));
        $manager->persist($passengerCathy);

        $passengerMarry = new Passenger();
        $passengerMarry->setName('Marry');
        $passengerMarry->setAddress('Street5 55, 12345NO');
        $passengerMarry->setArea($amsterdamArea);
        $passengerMarry->setCity('Amsterdam');
        $passengerMarry->setIsSubsidized(false);
        $passengerMarry->setLeftBudgetInKm(0);
        $passengerMarry->setRegistrationDate(new DateTimeImmutable('2022-05-01'));
        $manager->persist($passengerMarry);
        $manager->flush();

        $this->addReference(self::PASSENGER_JOHN, $passengerJohn);
        $this->addReference(self::PASSENGER_TIM, $passengerTim);
        $this->addReference(self::PASSENGER_JANE, $passengerJane);
        $this->addReference(self::PASSENGER_MARRY, $passengerMarry);
        $this->addReference(self::PASSENGER_CATHY, $passengerCathy);
    }

    public function getDependencies(): array
    {
        return [
            AreaFixtures::class,
        ];
    }
}
