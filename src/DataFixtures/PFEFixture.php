<?php

namespace App\DataFixtures;

use App\Entity\PFE;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PFEFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $repository = $manager->getRepository(\App\Entity\Enterprise::class);
            $randomEnterprise = rand(1, 200);
            $enterprise = $repository->findOneBy(['id' => $randomEnterprise], []);
            $pfe = new PFE();
            $pfe->setStudentName($faker->name);
            $pfe->setTitle($faker->title);
            $pfe->setEnterprise($enterprise);
            $manager->persist($pfe);
        }
        $manager->flush();
    }
}
