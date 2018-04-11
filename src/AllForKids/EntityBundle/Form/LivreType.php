<?php

namespace AllForKids\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;

class LivreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class,array('required'=>true , 'constraints' => array(new Length(array('min' => 3)))))
            ->add('categorie',ChoiceType::class, array(
                'required'=>true,
                'choices'  => array(
                    'conte 2-5 ans' => 'conte 2-5 ans',
                    'conte 6-10 ans' => 'conte 6-10 ans',
                    'Cours' => 'Cours',
                    'parascolaire' => 'parascolaire',
                    'gied parental' => 'gied parental',

                )))
            ->add('description',TextareaType::class,array('required'=>true, 'constraints' => array(new Length(array('min' => 20)))))
            
            ->add('type',ChoiceType::class, array(
        'required'=>true,
        'choices'  => array(
            'educatif' => 'educatif',
            'Histoire' => 'Histoire',
            'narratif' => 'narratif',
            'théâtre' => 'théâtre',
            'professionnels' => 'professionnels',
        )))
          
            ->add('photo',FileType::class, array('label' => 'Image','required'=>true,'constraints' => array(new File(array('mimeTypes' =>array('png','jpg'))))))
            ->add('url',FileType::class, array('label' => 'PDF','required'=>true,'constraints' => array(new File(array('mimeTypes' =>array('pdf'))))))
            ->add('Enregistre',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AllForKids\EntityBundle\Entity\Livre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'allforkids_entitybundle_livre';
    }


}
