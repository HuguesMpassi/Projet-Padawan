<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class CategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
//         $product = new Product();
//         $manager->persist($product);

//        $product->nom = "tshirt hulk";
//        $product->save();

        $categories = ['projet exo','projet école','projet entreprise','test de recrutement'];
        foreach($categories as $c) {
            $categorie = new Category();
            $categorie->setNom($c);
            $manager->persist($categorie);
            // INSERT INTO categorie set nom = 'projet exo'
            // INSERT INTO categorie set nom = 'projet école'
            // INSERT INTO categorie set nom = 'projet entreprise'
            // INSERT INTO categorie set nom = 'projet entreprise'
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['categories'];
    }
}
