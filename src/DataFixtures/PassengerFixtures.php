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

        $passengerJohn = $this->createPassenger(
            'John',
            'Street1 11, 12345FG',
            $utrechtArea,
            'Utrecht',
            '2022-01-01'
        );
        $manager->persist($passengerJohn);

        $passengerTim = $this->createPassenger(
            'Tim',
            'Street2 22, 12345HI',
            $utrechtArea,
            'Utrecht',
            '2022-02-01'
        );
        $manager->persist($passengerTim);

        $passengerJane = $this->createPassenger(
            'Jane',
            'Street3 33, 12345JK',
            $utrechtArea,
            'Amsterdam',
            '2022-03-01'
        );
        $manager->persist($passengerJane);

        $passengerCathy = $this->createPassenger(
            'Cathy',
            'Street4 44, 12345LM',
            $amsterdamArea,
            'Amsterdam',
            '2022-04-01'
        );
        $manager->persist($passengerCathy);

        $passengerMarry = $this->createPassenger(
            'Marry',
            'Street5 55, 12345NO',
            $amsterdamArea,
            'Amsterdam',
            '2022-05-01'
        );
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

    private function createPassenger(
        string $name,
        string $address,
        Area $area,
        string $city,
        string $registrationDate
    ): Passenger {
        $passengerJohn = new Passenger();
        $passengerJohn->setName($name);
        $passengerJohn->setAddress($address);
        $passengerJohn->setArea($area);
        $passengerJohn->setCity($city);
        $passengerJohn->setIsSubsidized(true);
        $passengerJohn->setLeftBudgetInKm(0);
        $passengerJohn->setRegistrationDate(new DateTimeImmutable($registrationDate));

        return $passengerJohn;
    }
}
