<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Program;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        ['Dr.House','Un médecin génial, mais insupportable', 'Comédie'],
        ['Game of Thrones','Monde médiévale, guerre de familles','Fantastique'],
        ['Community','Un groupe d\'étudiants particulier dans une université communautaire','Comédie'],
        ['Kaamelott','La quête du Graal par une équipe de bras cassés','Comédie'],
        ['Scrubs','Le parcours de John Dorian, alias JD, de jeune diplômé en médecine, à médecin exceptionnel','Comédie'],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (static::PROGRAMS as $programToAdd) {
            $program = new Program();
            $program->setTitle($programToAdd[0]);
            $program->setSynopsis($programToAdd[1]);
            $program->setCategory($this->getReference('category_' . $programToAdd[2]));
            $manager->persist($program);
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
