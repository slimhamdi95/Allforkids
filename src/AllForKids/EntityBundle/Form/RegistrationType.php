<?php

namespace AllForKids\EntityBundle\Form;


use FOS\UserBundle\Form\Type\RegistrationFormType;
use FOS\UserBundle\FOSUserBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('cin')
                ->add('nom')
                ->add('prenom')
                ->add('date',DateType::class)
                ->add('picture', FileType::class, array('label' => 'Image'))
                ->add('roles',CollectionType::class, array(
                    'entry_type' => ChoiceType::class,
                    'entry_options' => array(
                        'label' => false,
                        'choices' => array(
                            'Parent'  => 'ROLE_PARENT'       ,
                            'Eléve'  => 'ROLE_ELEVE'        ,
                            'Responsable' =>  'ROLE_RESPONSABLE',
                            'Medecin' =>  'ROLE_MEDECIN'

                        )
                    )
                )
            );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AllForKids\EntityBundle\Entity\User'
        ));
    }
    public function getParent()
    {
        return RegistrationFormType::class;
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'allforkids_entitybundle_user';
    }
    public function getName()
    {
        return $this->getBlockPrefix();
    }

}
