<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Entity\Model;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("", name="app_main")
     */
    public function index(EntityManagerInterface $manager): Response
    {
        // $array = [
        //     ["audi", ['a1', 'a2', 'a3']],
        //     ["peugeot", ['106', '107', '108']],
        //     ["citroen", ['c1', 'c2', 'c3']]
        
        // ];
        // // dd($array);

        // $sizeArray = count($array); // 3

        // for($i = 0; $i < $sizeArray; $i++)
        // {
        //     $marque = new Marque();
        //     $marque->setNom($array[$i][0]);
        //     $manager->persist($marque);
        //     $manager->flush();
            
        //     $sizeArrayModele = count($array[$i][1]); // 3
        //     for($j = 0; $j < $sizeArrayModele; $j++ )
        //     {
        //         $modele = new Model();
        //         $modele->setNom($array[$i][$j]);
        //         // $modele->setVehicule($marque);
        //         $manager->persist($modele);
        //         $manager->flush();
        //     }

        // }


        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("Circuit", name="app_Circuit")
     */
    public function Circuit(): Response
    {
        return $this->render('main/circuit.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/adresse", name="app_adresse")
     */
    public function adresse(): Response
    {
        return $this->render('main/adresse.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    /**
     * @Route("/localisation", name="app_localisation")
     */
    public function localisation(): Response
    {
        return $this->render('main/localisation.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
