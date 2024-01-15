<?php

namespace App\Form;

use App\Entity\PiscineForme;
use App\Entity\PiscineListe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class ExtPiscineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => "Nom de la piscine",
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('prix', NumberType::class, [
                'label' => "Prix de la piscine",
                'html5' => true,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])

            ->add('securite', ChoiceType::class, [
                'label' => "Accessoires de sécurité",
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'choices' => [
                    "Alarme volumétrique" => 0,
                    "Couverture de sécurité" => 1,
                    "Barrière normalisée" => 2
                ],
            ])

            ->add('alarme_prix', NumberType::class, [
                'label' => "Prix de l'alarme",
                'html5' => true,
                'required' => false,
            ])

            ->add('couverture_prix', NumberType::class, [
                'label' => "Prix de la couverture",
                'html5' => true,
                'required' => false,
            ])

            ->add('barriere_prix', NumberType::class, [
                'label' => "Prix de la barrière",
                'html5' => true,
                'required' => false,
            ])

            ->add('forme', EntityType::class, [
                'class' => PiscineForme::class,
                'choice_label' => 'nom',
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('image', DropzoneType::class, [
                'label' => "Image de la piscine",
                'data_class' => null,
                'mapped' => false,
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
            'data_class' => PiscineListe::class,
        ]);
    }
}
