<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UserProfileType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{

     /**
     * @Route("", name="app_profile")
     */
    public function profile()
    {
        return $this->render('profile/profile.html.twig');
    }




    /**
     * @Route("/modifier", name="app_modifier", methods={"GET", "POST"} )
     */
    public function modifier(EntityManagerInterface $manager, Request $request, UserPasswordHasherInterface $userpassword): Response

    {
        $user = $this->getUser();
        // dd($user);
        $form = $this->createForm(RegistrationFormType::class, $user, ["avatar" => true, "datas" => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) 
        {
            //dd($user);
            $avatarFile = $form->get('avatarUpdate')->getData();

            if($avatarFile)
            {
                $nomAvatar = date('YmdHis')."-".uniqid().".".$avatarFile->getClientOriginalExtension();

                $avatarFile->move(
                    $this->getParameter("imageUpload2"),
                    $nomAvatar
                );

                if($user->getAvatar())
                    {
                        unlink($this->getParameter('imageUpload2') . "/" . $user->getAvatar());
                    }

                    $user->setAvatar($nomAvatar);
            }


            // $user->setPassword($encodePassword);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Votre profile à bien été modifié !');

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);

            
        }
        
        return $this->render('profile/modifier.html.twig', [
            'user' => $user,
            'formProfile' => $form->createView(),
        ]);
    }

}
