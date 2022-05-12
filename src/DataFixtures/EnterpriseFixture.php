<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EnterpriseFixture extends Fixture
{ public function load(ObjectManager $manager): void
{
    $faker = Factory::create();
    for($i = 0 ; $i< 100 ; $i++) {
        $enterprise = new \App\Entity\Enterprise();
        $enterprise->setDesignation($faker->company);
        $manager->persist($enterprise);
    }
    $manager->flush();
}
}
