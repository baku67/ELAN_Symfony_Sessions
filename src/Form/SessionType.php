<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Training;
use App\Entity\Trainer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('begin_date', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('end_date', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('nbr_places', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])

            // ->add('trainees')

            ->add('trainer')
            // Selection parmies les entités formateurs(trainers) 
            ->add('trainer', EntityType::class, [
                'class' => Trainer::class,
                // 'choice_label' => 'title',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])


            // Selection parmies les entités formation(trainings) DESACTIVE car on est déjà sur la page de la formation "mère"
            // Problème: en mettant training en disable, la value est nulle (essayer readonly ou donner la value par defaut)
            ->add('training', EntityType::class, [
                'class' => Training::class,
                'choice_label' => 'title',
                // 'readonly' => true,
                'attr' => [
                    'class' => 'form-control',
                    'disabled' => true,
                    
                    // 'value' => 
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
            'data_class' => Session::class,
        ]);
    }
}
