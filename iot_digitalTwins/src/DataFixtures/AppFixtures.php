<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setPseudo('Steven')
            ->setRoles(['ROLE_USER'])
            ->setPassword("123456");
            $manager->persist($user);

        $user = new User();
        $user->setPseudo('Théo')
            ->setRoles(['ROLE_USER'])
            ->setPassword("123456");
            $manager->persist($user);

        $user = new User();
        $user->setPseudo('Amos')
            ->setRoles(['ROLE_USER'])
            ->setPassword("123456");
            $manager->persist($user);

        $manager->flush();
    }
}
