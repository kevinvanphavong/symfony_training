<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $itemsData = [
            ['reference' => '1', 'title' => 'item title 1', 'description' => 'item description 1', 'category' => 'category_1'],
            ['reference' => '2', 'title' => 'item title 2', 'description' => 'item description 2', 'category' => 'category_1'],
            ['reference' => '3', 'title' => 'item title 3', 'description' => 'item description 3', 'category' => 'category_2'],
            ['reference' => '4', 'title' => 'item title 4', 'description' => 'item description 4', 'category' => 'category_2'],
            ['reference' => '5', 'title' => 'item title 5', 'description' => 'item description 5', 'category' => 'category_2'],
            ['reference' => '6', 'title' => 'item title 6', 'description' => 'item description 6', 'category' => 'category_3'],
        ];

        foreach ($itemsData as $itemData) {
            $item = new Item();
            $categoryReference = $this->getReference($itemData['category'], Category::class);
            $item->setCategory($categoryReference);
            $item->setTitle($itemData['title']);
            $item->setDescription($itemData['description']);
            $this->addReference('item_' . $itemData['reference'], $item);
            $manager->persist($item);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
