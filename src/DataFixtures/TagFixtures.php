<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
       $tags = ['php','javascript','react.js','react native','vue.js','angular','node.js','mongodb','mysql','sql','html','css'];

       foreach($tags as $t) {
           $tag = new Tag();
           $tag->setNom($t);
           $manager->persist($tag);
       }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['tags'];
    }


}
