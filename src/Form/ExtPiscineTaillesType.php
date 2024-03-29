<?php

namespace App\Form;

use App\Entity\PiscineTailles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class ExtPiscineTaillesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', DropzoneType::class, [
                'label' => "Image de la dimension",
                'required' => false,
                'data_class' => null,
                'mapped' => false,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('taille', TextType::class, [
                'label' => "Nouvelle dimension",
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('prix', NumberType::class, [
                'label' => "Prix de la dimension (En €)",
                'html5' => true,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])

            ->add('secu_alarme', CheckboxType::class, [
                'label' => "Alarme volumétrique",
                'required' => false
            ])
            ->add('secu_cover', CheckboxType::class, [
                'label' => "Couverture de sécurité",
                'required' => false
            ])
            ->add('secu_barrier', CheckboxType::class, [
                'label' => "Barrière normalisée",
                'required' => false
            ])
            ->add('revet_poly', CheckboxType::class, [
                'label' => "Revêtement polymère",
                'required' => false
            ])
            ->add('liner', CheckboxType::class, [
                'label' => "Liner",
                'required' => false
            ])

            ->add('secu_alarme_prix', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => "Prix de l'alarme",
                    'aria-label' => "Prix de l'alarme",
                ]
            ])
            ->add('secu_cover_prix', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => "Prix de la couverture",
                    'aria-label' => "Prix de la couverture",
                ]
            ])
            ->add('secu_barrier_prix', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => "Prix de la barrière",
                    'aria-label' => "Prix de la barrière",
                ]
            ])
            ->add('revet_poly_price', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => "Prix du revêtement polymère",
                    'aria-label' => "Prix du revêtement polymère",
                ]
            ])
            ->add('liner_price', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => "Prix du liner",
                    'aria-label' => "Prix du liner",
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
            'data_class' => PiscineTailles::class,
        ]);
    }
}
