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
        for ($i = 0; $i < 10; $i++) {
            for ($j=1;$j<8;$j++) {
                for ($k=1;$k<13;$k++) {
                    $episode = new Episode();
                    $episode->setNumber($k);
                    $episode->setTitle($faker->sentence(3));
                    $episode->setSynopsis($faker->paragraphs(2, true));
                    $episode->setDuration($faker->numberBetween(15, 45));
                    $episode->setSeason($this->getReference('season_' . $i.$j));
                    $slug = $this->slugger->slug($episode->getTitle());
                    $episode->setSlug($slug);
                    $manager->persist($episode);
                }
            }
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