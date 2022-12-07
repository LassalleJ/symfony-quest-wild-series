<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    public function load(ObjectManager $manager):void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 900; $i++) {
            $episode = new Episode();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $episode->setNumber($faker->numberBetween(1, 10));
            $episode->setTitle($faker->sentence(3));
            $episode->setSynopsis($faker->paragraphs(2, true));
            $episode->setDuration($faker->numberBetween(15, 45));
            $episode->setSeason($this->getReference('season_' . $faker->numberBetween(0, 124)));
            $slug = $this->slugger->slug($episode->getTitle());
            $episode->setSlug($slug);
            $manager->persist($episode);
        }

        $manager->flush();

    }
    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class,
        ];
    }

}