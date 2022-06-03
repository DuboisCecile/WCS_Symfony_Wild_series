<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ActorFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager): void
    {
        // $faker = Faker\Factory::create('fr_FR');
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);
            $manager->persist($actor);
        }
        $manager->flush();
    }
}
