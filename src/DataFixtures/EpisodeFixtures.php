<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager):void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 900; $i++) {
            $episode = new Episode();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $episode->setNumber($faker->numberBetween(1, 10));
            $episode->setTitle($faker->sentence(3));
            $episode->setSynopsis($faker->paragraphs(2, true));
            $episode->setSeason($this->getReference('season_' . $faker->numberBetween(0, 124)));

            $manager->persist($episode);
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