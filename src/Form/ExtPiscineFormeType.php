<?php

namespace App\Form;

use App\Entity\PiscineForme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class ExtPiscineFormeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => "Nom de la forme",
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('image', DropzoneType::class, [
                'label' => "Image de la forme",
                'required' => false,
                'data_class' => null,
                'mapped' => false,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('btn_name', TextType::class, [
                'label' => "Nom du bouton externe",
                'required' => false,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('btn_link', UrlType::class, [
                'label' => "Lien du bouton externe",
                'required' => false,
                'row_attr' => [
                    'class' => 'mb'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Envoyer",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PiscineForme::class,
        ]);
    }
}
