<?php

namespace App\DataFixtures;

use App\Entity\Bid;
use App\Entity\Item;
use App\Entity\User;
use DateTimeZone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BidFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $datetime = new \DateTime('now', new DateTimeZone('Europe/Paris'));

        // Pour le user #1
        for ($i = 1; $i <= 2; $i++) {
            $bid = new Bid();
            $bid->setClient($this->getReference('user_1', User::class));
            $bid->setItem($this->getReference('item_' . $i, Item::class));
            $bid->setPrice(150 * $i);
            $bid->setCreationDate($datetime);
            $manager->persist($bid);
        }

        // Pour le user #2
        for ($i = 1; $i <= 2; $i++) {
            $bid = new Bid();
            $bid->setClient($this->getReference('user_2', User::class));
            $bid->setItem($this->getReference('item_' . $i, Item::class));
            $bid->setPrice(150 * $i + 5);
            $bid->setCreationDate($datetime);
            $manager->persist($bid);
        }

        // Pour le user #4
        for ($i = 1; $i <= 2; $i++) {
            $bid = new Bid();
            $bid->setClient($this->getReference('user_4', User::class));
            $bid->setItem($this->getReference('item_' . $i, Item::class));
            $bid->setPrice(150 * $i + 10);
            $bid->setCreationDate($datetime);
            $manager->persist($bid);
        }

        // Pour le user #5
        for ($i = 1; $i <= 2; $i++) {
            $bid = new Bid();
            $bid->setClient($this->getReference('user_5', User::class));
            $bid->setItem($this->getReference('item_' . $i, Item::class));
            $bid->setPrice(150 * $i + 15);
            $bid->setCreationDate($datetime);
            $manager->persist($bid);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ItemFixtures::class,
        ];
    }
}
