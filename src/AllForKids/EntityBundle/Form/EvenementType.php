<?php

namespace AllForKids\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('descriptionn',	TextareaType::class)
            ->add('date',DateType::class,array(
                'widget' => 'choice',
                'html5' => false,

            ))
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Maybe' => 'Maybe',
                    'Yes' => 'Yes',
                    'No' => 'No',
                )))
            ->add('nbrParticipation')
            ->add('photo',FileType::class, array('label' => 'Image'))
            ->add('temp',TimeType::class,array(
                'widget' => 'choice',
                'html5' => false,))
            ->add('Enregistre',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AllForKids\EntityBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'allforkids_entitybundle_evenement';
    }


}