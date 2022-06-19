<?php

namespace App\DataFixtures;

use App\Entity\Model;
use App\Entity\Marque;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $array = [
            ["audi", ['a1', 'a2', 'a3']],
            ["peugeot", ['106', '107', '108']],
            ["citroen", ['c1', 'c2', 'c3']]
        
        ];
        // dd($array);

        $sizeArray = count($array); // 3

        for($i = 0; $i < $sizeArray; $i++)
        {
            $marque = new Marque();
            $marque->setNom($array[$i][0]);
            $manager->persist($marque);
            $manager->flush();
            
            $sizeArrayModele = count($array[$i][1]); // 3
            for($j = 0; $j < $sizeArrayModele; $j++ )
            {
                $modele = new Model();
                $modele->setNom($array[$i][$j]);
                $modele->setMarque($marque);
                $manager->persist($modele);
                $manager->flush();
            }

        }

        $manager->flush();
    }
}
