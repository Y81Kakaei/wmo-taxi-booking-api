<?php

namespace App\DataFixtures;

use App\Entity\Area;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AreaFixtures extends Fixture
{
    public const AREA_UTRECHT = 'utrecht';
    public const AREA_AMSTERDAM = 'amsterdam';

    public function load(ObjectManager $manager): void
    {
        $areaUtrecht = new Area();
        $areaUtrecht->setName('Utrecht Overvecht');
        $manager->persist($areaUtrecht);

        $areaAmsterdam = new Area();
        $areaAmsterdam->setName('Amsterdam Noord');
        $manager->persist($areaAmsterdam);

        $manager->flush();

        $this->addReference(self::AREA_UTRECHT, $areaUtrecht);
        $this->addReference(self::AREA_AMSTERDAM, $areaAmsterdam);
    }
}
