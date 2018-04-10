<?php

namespace AllForKids\EntityBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $builder->add('nom',TextType::class,array('required'=>true))
            ->add('descriptionn',	TextareaType::class,array('required'=>true))
            ->add('date',DateType::class,array(
                'widget' => 'choice',
                'html5' => false,
                'required'=>true

            ))
            ->add('type', ChoiceType::class, array(
                'required'=>true,
                'choices'  => array(
                    'musique' => 'musique',
                    'cinema' => 'cinema',
                    'randonnée' => 'randonnée',
                    'theatre' => 'theatre',
                    'magicien' => 'magicien',
                    'Parck' => 'Parck',
                )))
            ->add('nbrParticipation',IntegerType::class,array('required'=>true))
            ->add('photo',FileType::class, array('label' => 'Image','required'=>true))
            ->add('temp',TimeType::class,array(
                'required'=>true,
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
