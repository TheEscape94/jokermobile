<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Categories_kitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('upName', ChoiceType::class, array(
                'choices' => array(
                    'Standardna oprema' => 0,
                    'Dodatna oprema' => 1,
                    'Maske i folije' => 2,
                ),
                'label' => 'Nadkategorija',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('name', null, array('label' => 'Naziv kategorije:', 'attr' => array('class' => 'form-control')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Categories_kit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_categories_kit';
    }


}
