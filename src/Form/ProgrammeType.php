<?php

namespace App\Form;

use App\Entity\Programme;
use App\Entity\Module;
use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('length', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('session', EntityType::class, [
                'class' => Session::class,
                'attr' => [
                    'class' => 'form-control readonly',
                ]
            ])
            ->add('module', EntityType::class, [
                'class' => Module::class,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Sélectionnez un module',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Programme::class,
        ]);
    }
}
