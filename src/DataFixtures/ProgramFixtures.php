<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Program;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker= Factory::create();
        for($i=0;$i<25;$i++) {
            $program = new Program();
            $program->setTitle($faker->sentence(2));
            $program->setSynopsis($faker->paragraph(3, true));
            $program->setCategory($this->getReference('category_' . $faker-> numberBetween(0,5)));
            $manager->persist($program);
            $this->addReference('program_' . $i, $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
        
    }
}
