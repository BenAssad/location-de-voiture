<?php

namespace App\Controller;

use App\Filter\VehiculeFilter;
use App\Form\FilterType;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    /**
     * @Route("/vehicule", name="app_vehicule")
     */
    public function catalogue(VehiculeRepository $repoVehicule, Request $request): Response
    {   
        $filter = new VehiculeFilter;
        $form = $this->createForm(FilterType::class, $filter);
        $form->handleRequest($request);
        

        $vehicules = $repoVehicule->findFiltre($filter);

        return $this->render('vehicule/catalogue.html.twig', [
            'vehicules' => $vehicules,
            'formFilter' =>$form->createView()
        ]);
    }

    /**
     * @Route("/vehicule/{id}", name="app_vehicule_detail")
     */
    public function detail($id, VehiculeRepository $repoVehicule, Request $request): Response
    {   
        $vehicules = $repoVehicule->find($id);

        return $this->render('vehicule/detail_vehicule.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }
    
}
