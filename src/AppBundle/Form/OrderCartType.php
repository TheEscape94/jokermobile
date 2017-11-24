<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderCartType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => "Ime:",
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('lastName', null, array(
                'label' => "Prezime:",
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('adress', null, array(
                'label' => "Adresa:",
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('city', null, array(
                'label' => "Grad:",
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('phone', null, array(
                'label' => "Telefon:",
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('email', null, array(
                'label' => "Email:",
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\OrderCart'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ordercart';
    }


}
