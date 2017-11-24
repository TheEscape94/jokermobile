<?php

namespace AppBundle\Form;
use AppBundle\Entity\Categories_phones;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class PhonesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mark', HiddenType::class, array(
                'attr' => array(
                    'class' => 'form-control hiden-mark'
                )
            ))
            ->add('model', null, array(
                'label' => 'Model:',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('isNew', ChoiceType::class, array(
                'choices' => array(
                    'Nov' => 0,
                    'Polovan' => 1,
                ),
                'label' => 'Telefon je:',
                'attr' => array(
                    'class' => 'form-control parent-half',
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
                'label' => 'Stanje:',
                'attr' => array(
                    'class' => 'form-control parent-half',
                )
            ))
            ->add('garanty', ChoiceType::class, array(
                'choices' => array (
                    'Standardna (7 dana)' => 0,
                    'Fabrička (12 meseci)' => 1,
                ),
                'label' => 'Garancija:',
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('kit', ChoiceType::class, array(
                'choices' => array(
                    'Sve (punjač, slušalice, kutija)' => 0,
                    'Punjač i slušalice' => 1,
                    'Punjač' => 2,
                ),
                'label' => 'Oprema:',
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Opis telefona:',
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => '8',
                    'style' => 'resize:none; font-size: 12px;',
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
                'label' => 'Mreža:',
                'attr' => array (
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('quantity', null, array(
                'label' => 'Količina:',
                'attr' => array(
                    'class' => 'form-control parent-half'
                )
            ))
            ->add('images', FileType::class, array(
                'multiple' => 'true',
                'label' => 'Fotografije (max 8):',
                'attr' => array(
                    'class' => 'form-control results-preview',
                    'style' => 'display:none',
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
            'data_class' => 'AppBundle\Entity\Phones',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_phones';
    }


}
