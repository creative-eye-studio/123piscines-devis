<?php

namespace App\Form;

use App\Entity\Filtrations;
use App\Entity\PiscineForme;
use App\Entity\PiscineListe;
use App\Entity\PiscineTailles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class FiltrationsType extends AbstractType
{
    private $em;

    function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nom', EntityType::class, [
                'label' => "Nom de la piscine",
                'class' => PiscineListe::class,
                'choice_label' => 'nom',
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])

            ->add('prix', NumberType::class, [
                'label' => "Prix au mètre linéaire (En €)",
                'html5' => true,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])

            ->add('type', ChoiceType::class, [
                'label' => 'Type de filtration',
                'choices' => [
                    "Filtre à sable" => 0,
                    "Bloc filtrant" => 1,
                    "Eco Responsable" => 2,
                    "Sans filtration" => 3,
                ],
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])

            ->add('tailles', EntityType::class, [
                'label' => 'Taille',
                'class' => PiscineTailles::class,
                'choice_label' => 'taille',
                'group_by' => 'piscine.nom',
                'mapped' => false,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('image', DropzoneType::class, [
                'label' => "Image de la filtration",
                'data_class' => null,
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
            'data_class' => Filtrations::class,
            'attr' => [
                'id' => 'filter-form'
            ]
        ]);
    }
}
