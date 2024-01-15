<?php

namespace App\Form;

use App\Entity\PiscineEsc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class ExtPiscineEscType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('prix', NumberType::class, [
                'label' => "Plus value de l'élément (En €)",
                'html5' => true,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    "Petit bain" => 0,
                    "Escalier" => 1,
                    "Échelle" => 2,
                    "Revètement polymère" => 3,
                    "SPA à débordement" => 4,
                    "Alarme volumétrique" => 5,
                    "Couverture de sécurité" => 6,
                    "Barrière normalisée" => 7,
                ],
                'row_attr' => [
                    'class' => 'mb'
                ],
                'label' => "Type d'élément",
            ])
            ->add('image', DropzoneType::class, [
                'data_class' => null,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => "Description (optionnel)",
                'required' => false,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Envoyer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PiscineEsc::class,
        ]);
    }
}
