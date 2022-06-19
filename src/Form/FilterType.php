<?php

namespace App\Form;

use App\Entity\Model;
use App\Entity\Marque;
use App\Entity\Couleur;
use App\Entity\Categorie;
use App\Filter\VehiculeFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categorie', EntityType::class, [
                "class" => Categorie::class,
                "choice_label" => "nom",
                "multiple" => true,
                "expanded" => true,
                "required" => false
            ])
            ->add('marque', EntityType::class, [
                "class" => Marque::class,
                "choice_label" => "nom",
                "multiple" => true,
                "expanded" => true,
                "required" => false
            ])
            ->add('model', EntityType::class, [
                "class" => Model::class,
                "choice_label" => "nom",
                "multiple" => true,
                "expanded" => true,
                "required" => false
            ])
            ->add('couleur', EntityType::class, [
                "class" => Couleur::class,
                "choice_label" => "nom",
                "multiple" => true,

                "expanded" => true,
                "required" => false
            ])
            ->add('min', TextType::class, [
                "required" => false
            ])
            ->add('max', TextType::class, [
                "required" => false
            ])
            ->add('recherche', TextType::class, [
                "required" => false
            ])
            ->add('order', ChoiceType::class , [
                "required" => false,
                "choices" => [
                    "Prix croissant" => 1,
                    "Prix decroissant" => 2,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VehiculeFilter::class
            // Configure your form options here
        ]);
    }
}
