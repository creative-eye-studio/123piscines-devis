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
            ->add('color', ChoiceType::class, [
                'choices' => [
                    "Sans couleurs" => 0,
                    "Blanc" => 1,
                    "Bleu" => 2,
                    "Vert" => 3,
                    "Turquoise" => 4,
                ],
                'row_attr' => [
                    'class' => 'mb'
                ],
                'label' => "Type d'élément",
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    "Petit bain" => 0,
                    "Escalier" => 1,
                    "Échelle" => 2,
                    "SPA à débordement" => 3,
                    "Alarme volumétrique" => 4,
                    "Couverture de sécurité" => 5,
                    "Barrière normalisée" => 6,
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
