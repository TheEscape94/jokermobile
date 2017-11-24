<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EquimentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', HiddenType::class, array(
                'attr' => array(
                    'class' => 'form-control category-int'
                )
            ))
            ->add('mark', null, array(
                'label' => 'Marka opreme:',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('name', null, array(
                'label' => 'Naziv opreme:',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('myPrice', null, array(
                'label' => 'Nabavna cena (RSD):',
                'attr' => array(
                    'class' => 'form-control parent-third'
                )
            ))
            ->add('priceOff', null, array(
                'label' => 'Popust (%):',
                'attr' => array(
                    'class' => 'form-control parent-third'
                )
            ))
            ->add('price', null, array(
                'label' => 'Prodajna cena (RSD):',
                'attr' => array(
                    'class' => 'form-control parent-third'
                )
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Opis opreme:',
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => '8',
                    'style' => 'resize:none; font-size: 12px;',
                )
            ))
            ->add('images', FileType::class, array(
                'multiple' => 'true',
                'label' => 'Fotografije (max 4):',
                'attr' => array(
                    'class' => 'form-control results-preview-eq',
                    'style' => 'display:none',
                )
            ))
            ->add('videoLink', null, array(
                'label' => 'Video link (youtube):',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('link', null, array(
                'label' => 'Link:',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('funFact', TextareaType::class, array(
                'label' => 'Zanimljivost',
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => '5',
                    'style' => 'resize:none; font-size: 12px;',
                )
            ))
            ->add('tags', null, array(
                'label' => 'Tagovi',
                'attr' => array(
                    'class' => 'form-control add-tags',
                    'readonly' => true,
                    'required' => false,
                    'style' => 'background: #f6f6f6; border: 2px solid #00A8FF; border-radius: 4px;'
                )
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Equiment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_equiment';
    }


}
