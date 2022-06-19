<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

            if($options['avatar'])
            {
                $builder
                    ->add('avatarUpdate', FileType::class,[
                        "required" => false,
                        "mapped" => false
                    ])
                ;
            }

            if($options['datas'])
            {
                $builder
                    ->add('email', EmailType::class, [
                        "required" => false,
                        "attr" => [
                            "placeholder" => "Email"
                        ]
                    ])
                    ->add('telephone', TextType::class, [
                        "required"=> false,
                        "attr"=> [
                            "placeholder"=>"Téléphone"
                        ]
                    ])
                    ->add('prenom', TextType::class, [
                        "required"=> false,
                        "attr"=> [
                            "placeholder"=>"Prenom"
                        ]
                    ])
                    ->add('nom', TextType::class, [
                        "required"=> false,
                        "attr"=> [
                            "placeholder"=>"Nom"
                        ]
                    ])
                    ->add('born_at', DateType::class,[
                        "required"=> false,
                        "label" => "Date de naissance",
                        "widget" => "single_text",
                        "attr"=> [
                            "placeholder"=>"Date de naissance"
                        ]
                    ])
                ;

            }
            if($options["password"])
            {
                $builder
                    ->add('plainPassword', PasswordType::class, [
                        // instead of being set onto the object directly,
                        // this is read and encoded in the controller
                        'mapped' => false,
                        'attr' => ['autocomplete' => 'new-password'],
                        'constraints' => [
                            new NotBlank([
                                'message' => 'Please enter a password',
                            ]),
                            new Length([
                                'min' => 6,
                                'minMessage' => 'Your password should be at least {{ limit }} characters',
                                // max length allowed by Symfony for security reasons
                                'max' => 4096,
                            ]),
                        ],
                    ])
                ;
            }
            if($options["agree"])
            {
                $builder
                ->add('agreeTerms', CheckboxType::class, [
                    'mapped' => false,
                    'constraints' => [
                        new IsTrue([
                            'message' => 'You should agree to our terms.',
                        ]),
                    ],
                ])
                ;
            }
            
            

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'datas' => false,
            'password' => false,
            'agree' => false,
            'avatar' => false
        ]);
    }
}
