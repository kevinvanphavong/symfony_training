<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $userData = [
            ['reference' => '1' ,'username' => 'john.doe@example.com', 'firstname' => 'John', 'lastname' => 'Doe', 'roles' => ['ROLE_USER']],
            ['reference' => '2' ,'username' => 'jane.smith@example.com', 'firstname' => 'Jane', 'lastname' => 'Smith', 'roles' => ['ROLE_USER']],
            ['reference' => '3' ,'username' => 'admin@example.com', 'firstname' => 'Admin', 'lastname' => 'User', 'password' => 'admin123', 'roles' => ['ROLE_ADMIN']],
            ['reference' => '4' ,'username' => 'alice.wonder@example.com', 'firstname' => 'Alice', 'lastname' => 'Wonder', 'roles' => ['ROLE_USER']],
            ['reference' => '5' ,'username' => 'bob.builder@example.com', 'firstname' => 'Bob', 'lastname' => 'Builder', 'roles' => ['ROLE_USER']],
        ];

        foreach ($userData as $data) {
            $user = new User();
            $user->setUserName($data['username']);
            $user->setFirstName($data['firstname']);
            $user->setLastName($data['lastname']);
            $user->setRoles($data['roles']);

            // Hachage du mot de passe
            $password = $this->passwordHasher->hashPassword($user, 'password123');
            $user->setPassword($password);

            // Persist l'utilisateur dans la base
            $manager->persist($user);

            $this->addReference('user_'.$data['reference'], $user);
        }

        // Sauvegarde en base de données
        $manager->flush();
    }
}
