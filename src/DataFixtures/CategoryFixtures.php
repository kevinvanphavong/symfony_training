<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $categoriesData = [
          ['reference' => '1', 'name' => 'Jackets'],
          ['reference' => '2', 'name' => 'Pants'],
          ['reference' => '3', 'name' => 'Sneakers'],
        ];

        foreach ($categoriesData as $data) {
            $category = new Category();
            $category->setName($data['name']);
            $manager->persist($category);
            $this->addReference('category_'.$data['reference'], $category);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
