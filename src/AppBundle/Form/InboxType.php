<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InboxType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Ime i prezime:',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('email', null, array(
                'label' => 'Email:',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('phone', null, array(
                'label' => 'Telefon:',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('subject', null, array(
                'label' => 'Naslov:',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('msg', TextareaType::class, array(
                'label' => 'Poruka:',
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'resize:none',
                )
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Inbox'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_inbox';
    }


}
