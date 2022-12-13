<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;

    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $user1 = new User();
        $user1->setEmail($faker->email());
        $user1->setPassword($this->passwordHasher->hashPassword($user1, '123456789'));
        $user1->setRoles(['ROLE_USER']);
        $this->addReference('user_1', $user1);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail($faker->email());
        $user2->setPassword($this->passwordHasher->hashPassword($user2, 'adminuser'));
        $user2->setRoles(['ROLE_CONTRIBUTOR']);
        $this->addReference('user_2', $user2);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail($faker->email());
        $user3->setPassword($this->passwordHasher->hashPassword($user1, '123456789'));
        $user3->setRoles(['ROLE_ADMIN']);
        $this->addReference('user_3', $user3);
        $manager->persist($user3);
        $manager->flush();
    }
}
