<?php

namespace EtablissementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\View\ChoiceListView;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EtablissementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('type', ChoiceType::class, array(
            'choices'   => array(
                'Garderie'   => 'Garderie',
                'jardin d\'enfant' => 'jardin d\'enfant',
                'ecole primaire'   => 'ecole primaire',
                'colége'   => 'colége',
                'lycée'   => 'lycée',
            ),
            'multiple'  => false,
        )) ->add('region',EntityType::class,['class'=>'EtablissementBundle\Entity\Region']
            )
            ->add('description',TextareaType::class)->add('image', FileType::class, array('label' => 'Image(JPG)','data_class' => null))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EtablissementBundle\Entity\Etablissement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'etablissementbundle_etablissement';
    }


}
