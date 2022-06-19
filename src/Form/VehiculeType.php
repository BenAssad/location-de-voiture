<?php

namespace App\Form;

use App\Entity\Model;
use App\Entity\Vehicule;
use App\Entity\Categorie;
use App\Entity\Couleur;
use App\Entity\Marque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('immat')
            
            ->add('categorie', EntityType::class, [
                "class" => Categorie::class,
                "required" => false,
                "choice_label" => "nom",
                "attr" => [
                    
                ]
            ])
            ->add('marque', EntityType::class, [
                "class" => Marque::class,
                "required" => false,
                'mapped' => false,
                "choice_label" => "nom",
                "attr" => [
                    
                ]
            ])
            ->add('model', EntityType::class, [
                "class" => Model::class,
                "required" => false,
                'mapped' => false,
                "choice_label" => "nom",
                "attr" => [
                ]
            ])
            ->add('couleurs', EntityType::class, [
                "class" => Couleur::class,
                "required" => false,
                "multiple" => true,
                "choice_label" => "nom",
                
            ])
            ->add('description')
            ->add('prix')
            //->add('typemoteur')
            // ->add('couleur')
            //->add('boite')
            //->add('disponible')
            ->add('images',FileType::class, [
                "required" => false,
                "mapped" => false,
                "multiple" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
