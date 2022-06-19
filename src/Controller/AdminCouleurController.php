<?php

namespace App\Controller;

use App\Entity\Couleur;
use App\Form\Couleur1Type;
use App\Repository\CouleurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/couleur")
 */
class AdminCouleurController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_couleur_index", methods={"GET"})
     */
    public function index(CouleurRepository $couleurRepository): Response
    {
        return $this->render('admin_couleur/index.html.twig', [
            'couleurs' => $couleurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_couleur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CouleurRepository $couleurRepository): Response
    {
        $couleur = new Couleur();
        $form = $this->createForm(Couleur1Type::class, $couleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $couleurRepository->add($couleur, true);

            return $this->redirectToRoute('app_admin_couleur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_couleur/new.html.twig', [
            'couleur' => $couleur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_couleur_show", methods={"GET"})
     */
    public function show(Couleur $couleur): Response
    {
        return $this->render('admin_couleur/show.html.twig', [
            'couleur' => $couleur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_couleur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Couleur $couleur, CouleurRepository $couleurRepository): Response
    {
        $form = $this->createForm(Couleur1Type::class, $couleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $couleurRepository->add($couleur, true);

            return $this->redirectToRoute('app_admin_couleur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_couleur/edit.html.twig', [
            'couleur' => $couleur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_couleur_delete", methods={"POST"})
     */
    public function delete(Request $request, Couleur $couleur, CouleurRepository $couleurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$couleur->getId(), $request->request->get('_token'))) {
            $couleurRepository->remove($couleur, true);
        }

        return $this->redirectToRoute('app_admin_couleur_index', [], Response::HTTP_SEE_OTHER);
    }
}
