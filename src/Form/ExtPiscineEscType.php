<?php

namespace App\Form;

use App\Entity\PiscineEsc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('position', ChoiceType::class, [
                'choices' => [
                    "Haut - Gauche" => 0,
                    "Haut - Centre" => 1,
                    "Haut - Droit" => 2,
                    "Bas - Gauche" => 3,
                    "Bas - Centre" => 4,
                    "Bas - Droit" => 5,
                ],
                'row_attr' => [
                    'class' => 'mb'
                ],
                'label' => "Position de l'élément",
            ])
            ->add('image', DropzoneType::class, [
                'data_class' => null,
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
