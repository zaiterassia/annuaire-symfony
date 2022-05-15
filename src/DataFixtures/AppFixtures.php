<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;


class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        if (!$manager->find(User::class, 1)) {
            $user->setUsername('admin');
            $user->setRoles(["ROLE_ADMIN"]);
            $user->setPassword($this->hasher->hashPassword($user, 'admin'));
            $user->setFirstname('zaiter');
            $user->setLastname('assia');
            $user->setEmail('admin@example.com');
            $user->setActive(true);
            $user->setDeleted(false);
            $user->setAdmin(true);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
