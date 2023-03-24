<?php

namespace App\DataFixtures;

use App\Entity\Area;
use App\Entity\TaxiCompany;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TaxiCompanyFixtures extends Fixture implements DependentFixtureInterface
{
    public const TAXI_UTRECHT = 'sam-taxi';
    public const TAXI_AMSTERDAM = 'yaz-taxi';

    public function load(ObjectManager $manager): void
    {
        /** @var Area $utrechtArea */
        $utrechtArea = $this->getReference(AreaFixtures::AREA_UTRECHT);
        /** @var Area $amsterdamArea */
        $amsterdamArea = $this->getReference(AreaFixtures::AREA_AMSTERDAM);

        $utrechtTaxiCompany = new TaxiCompany();
        $utrechtTaxiCompany->setName('Sam\'s Taxi');

        $utrechtTaxiCompany->setArea($utrechtArea);
        $utrechtTaxiCompany->setAddress('Test 28, 1234AB');
        $manager->persist($utrechtTaxiCompany);

        $amsterdamTaxiCompany = new TaxiCompany();
        $amsterdamTaxiCompany->setName('Yaz\'s Taxi');

        $amsterdamTaxiCompany->setArea($amsterdamArea);
        $amsterdamTaxiCompany->setAddress('Test 29, 1234CD');
        $manager->persist($amsterdamTaxiCompany);

        $manager->flush();

        $this->addReference(self::TAXI_UTRECHT, $utrechtTaxiCompany);
        $this->addReference(self::TAXI_AMSTERDAM, $amsterdamTaxiCompany);
    }

    public function getDependencies(): array
    {
        return [
            AreaFixtures::class,
        ];
    }
}
