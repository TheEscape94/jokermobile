<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BuyingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phoneModel', null, array(
                'label' => 'Marka i model Vašeg telefona:*',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('isNew', ChoiceType::class, array(
                'choices' => array(
                    'Nov' => 0,
                    'Polovan' => 1,
                ),
                'label' => 'Vaš telefon je:*',
                'attr' => array(
                    'class' => 'form-control check-new',
                )
            ))
            ->add('stateNum', ChoiceType::class, array(
                'choices' => array(
                    '10/10' => 10,
                    '9.5/10' => 9.5,
                    '9/10' => 9,
                    '8.5/10' => 8.5,
                    '8/10' => 8,
                    '7/10' => 7,
                    '6/10' => 6,
                    '5/10' => 5,
                ),
                'label' => 'Stanje:*',
                'attr' => array(
                    'class' => 'form-control parent-half notnew',
                )
            ))
            ->add('network', ChoiceType::class, array(
                'choices' => array (
                    'SimFree' => 0,
                    'MTS' => 1,
                    'Telenor' => 2,
                    'Vip' => 3,
                    'Ostalo' => 4,
                ),
                'label' => 'Mreža:*',
                'attr' => array (
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('kit', ChoiceType::class, array(
                'choices' => array(
                    'Sve (punjač, slušalice, kutija)' => 0,
                    'Punjač i slušalice' => 1,
                    'Punjač' => 2,
                ),
                'label' => 'Oprema:*',
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('images', FileType::class, array(
                'multiple' => 'true',
                'label' => 'Fotografije:*',
                'attr' => array(
                    'class' => 'form-control results-preview-user',
                    'style' => 'display:none;',
                    'requred' => false,
                )
            ))
            ->add('price', null, array(
                'label' => 'Koja je Vaša željena cena? (u RSD)*',
                'attr' => array(
                    'class' => 'form-control field_check'
                )
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Opišite nam malo bolje Vaš telefon:*',
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => '5',
                    'style' => 'resize:none; font-size: 13px; padding:10px;',
                )
            ))
            ->add('name', null, array(
                'label' => 'Ime i prezime:*',
                'attr' => array(
                    'class' => 'form-control first-user-field'
                )
            ))
            ->add('phoneNum', null, array(
                'label' => 'Broj telefona:*',
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('email', null, array(
                'label' => 'E-mail:*',
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('adress', null, array(
                'label' => 'Adresa:*',
                'attr' => array(
                    'class' => 'form-control parent-third field_check'
                )
            ))
            ->add('city', null, array(
                'label' => 'Mesto:*',
                'attr' => array(
                    'class' => 'form-control parent-third field_check'
                )
            ))
            ->add('postNum', null, array(
                'label' => 'Poštanski broj:*',
                'attr' => array(
                    'class' => 'form-control parent-third field_check'
                )
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Buying'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_buying';
    }


}
