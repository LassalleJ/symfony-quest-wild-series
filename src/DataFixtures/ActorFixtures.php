<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use App\Entity\Category;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i=0;$i<10;$i++) {
            $actor= new Actor();
            $actor->setName('Actor' . $i);
            for($j=0;$j<3;$j++){
                $actor->addProgram($this->getReference('program_'. $faker->numberBetween(0, 9)));
            }
            $manager->persist($actor);


        }


        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
