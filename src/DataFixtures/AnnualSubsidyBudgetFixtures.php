<?php

namespace App\DataFixtures;

use App\Entity\AnnualSubsidyBudget;
use App\Entity\Resident;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnnualSubsidyBudgetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $residents[] = $this->getResident(ResidentFixtures::RESIDENT_JOHN);
        $residents[] = $this->getResident(ResidentFixtures::RESIDENT_TIM);
        $residents[] = $this->getResident(ResidentFixtures::RESIDENT_JANE);
        $residents[] = $this->getResident(ResidentFixtures::RESIDENT_MARRY);
        $residents[] = $this->getResident(ResidentFixtures::RESIDENT_CATHY);

        foreach ($residents as $resident) {
            $subsidy = new AnnualSubsidyBudget();
            $subsidy->setBudgetInKm(rand(400, 1000));
            $subsidy->setResident($resident);
            $manager->persist($subsidy);

            $resident->setLeftBudgetInKm($subsidy->getBudgetInKm());
            $manager->persist($resident);
        }

        $manager->flush();
    }

    /**
     * @param string $name
     */
    public function getResident($name, ?string $class = null): Resident
    {
        /** @var Resident $resident */
        $resident = parent::getReference($name, $class);

        return $resident;
    }

    public function getDependencies(): array
    {
        return [
            ResidentFixtures::class,
        ];
    }
}
