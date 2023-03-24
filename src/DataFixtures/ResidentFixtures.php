<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Area;
use App\Entity\Resident;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ResidentFixtures extends Fixture implements DependentFixtureInterface
{
    public const RESIDENT_JOHN = 'resident-john';
    public const RESIDENT_TIM = 'resident-tim';
    public const RESIDENT_JANE = 'resident-jane';
    public const RESIDENT_CATHY = 'resident-cathy';
    public const RESIDENT_MARRY = 'resident-marry';

    public function load(ObjectManager $manager): void
    {
        /** @var Area $utrechtArea */
        $utrechtArea = $this->getReference(AreaFixtures::AREA_UTRECHT);
        /** @var Area $amsterdamArea */
        $amsterdamArea = $this->getReference(AreaFixtures::AREA_AMSTERDAM);

        $residentJohn = new Resident();
        $residentJohn->setName('John');
        $residentJohn->setAddress('Street1 11, 12345FG');
        $residentJohn->setArea($utrechtArea);
        $residentJohn->setCity('Utrecht');
        $residentJohn->setIsSubsidized(true);
        $residentJohn->setLeftBudgetInKm(0);
        $residentJohn->setRegistrationDate(new DateTimeImmutable('2022-01-01'));
        $manager->persist($residentJohn);

        $residentTim = new Resident();
        $residentTim->setName('Tim');
        $residentTim->setAddress('Street2 22, 12345HI');
        $residentTim->setArea($utrechtArea);
        $residentTim->setCity('Utrecht');
        $residentTim->setIsSubsidized(true);
        $residentTim->setLeftBudgetInKm(0);
        $residentTim->setRegistrationDate(new DateTimeImmutable('2022-02-01'));
        $manager->persist($residentTim);

        $residentJane = new Resident();
        $residentJane->setName('Jane');
        $residentJane->setAddress('Street3 33, 12345JK');
        $residentJane->setArea($amsterdamArea);
        $residentJane->setCity('Amsterdam');
        $residentJane->setIsSubsidized(true);
        $residentJane->setLeftBudgetInKm(0);
        $residentJane->setRegistrationDate(new DateTimeImmutable('2022-03-01'));
        $manager->persist($residentJane);

        $residentCathy = new Resident();
        $residentCathy->setName('Cathy');
        $residentCathy->setAddress('Street4 44, 12345LM');
        $residentCathy->setArea($amsterdamArea);
        $residentCathy->setCity('Amsterdam');
        $residentCathy->setIsSubsidized(true);
        $residentCathy->setLeftBudgetInKm(0);
        $residentCathy->setRegistrationDate(new DateTimeImmutable('2022-04-01'));
        $manager->persist($residentCathy);

        $residentMarry = new Resident();
        $residentMarry->setName('Marry');
        $residentMarry->setAddress('Street5 55, 12345NO');
        $residentMarry->setArea($amsterdamArea);
        $residentMarry->setCity('Amsterdam');
        $residentMarry->setIsSubsidized(false);
        $residentMarry->setLeftBudgetInKm(0);
        $residentMarry->setRegistrationDate(new DateTimeImmutable('2022-05-01'));
        $manager->persist($residentMarry);
        $manager->flush();

        $this->addReference(self::RESIDENT_JOHN, $residentJohn);
        $this->addReference(self::RESIDENT_TIM, $residentTim);
        $this->addReference(self::RESIDENT_JANE, $residentJane);
        $this->addReference(self::RESIDENT_MARRY, $residentMarry);
        $this->addReference(self::RESIDENT_CATHY, $residentCathy);
    }

    public function getDependencies(): array
    {
        return [
            AreaFixtures::class,
        ];
    }
}
