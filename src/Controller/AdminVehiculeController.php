<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Form\Vehicule1Type;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/vehicule")
 */
class AdminVehiculeController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_vehicule_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $vehicules = $entityManager
            ->getRepository(Vehicule::class)
            ->findAll();

        return $this->render('admin_vehicule/index.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_vehicule_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $imagesFiles = $form->get('images')->getData();

            if($imagesFiles){
                foreach($imagesFiles as $objectFiles){

                    $nomImage = date('YmdHhis') ."-".uniqid().".".$objectFiles->getClientOriginalExtension();

                    $objectFiles->move(
                        $this->getParameter('imageUpload'),
                        $nomImage
                    );

                    $image = new Image;
                    $image->setNomImg($nomImage);
                    $image->setVehicule($vehicule);

                    $manager->persist($image);
                    $manager->flush();   
                }
            }

            
            $manager->persist($vehicule);
            $manager->flush();

            

            // dd($imagesFiles);

            return $this->redirectToRoute('app_admin_vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_vehicule/new.html.twig', [
            'vehicule' => $vehicule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_vehicule_show", methods={"GET"})
     */
    public function show(Vehicule $vehicule): Response
    {
        return $this->render('admin_vehicule/show.html.twig', [
            'vehicule' => $vehicule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_vehicule_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Vehicule $vehicule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imagesFiles = $form->get('images')->getData();

            if($imagesFiles){
                foreach($imagesFiles as $objectFiles){

                    $nomImage = date('YmdHhis') ."-".uniqid().".".$objectFiles->getClientOriginalExtension();

                    $objectFiles->move(
                        $this->getParameter('imageUpload'),
                        $nomImage
                    );

                    $image = new Image;
                    $image->setNomImg($nomImage);
                    $image->setVehicule($vehicule);

                    $entityManager->persist($image);
                    $entityManager->flush();   
                }
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_vehicule/edit.html.twig', [
            'vehicule' => $vehicule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_vehicule_delete", methods={"POST"})
     */
    public function delete(Request $request, Vehicule $vehicule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vehicule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vehicule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_vehicule_index', [], Response::HTTP_SEE_OTHER);
    }
}
