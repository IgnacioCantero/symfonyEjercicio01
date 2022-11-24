<?php

namespace App\Form;

use App\Entity\Juguetes;
use App\Entity\PublicoObjetivo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JugueteType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => Juguetes::class,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('marca', TextType::class)
            ->add('publicoObjetivo', EntityType::class, ['class'=>PublicoObjetivo::class])
        ;
    }

    public function getBlockPrefix()
    {
        return "";
    }
    public function getName()
    {
        return "";
    }

}