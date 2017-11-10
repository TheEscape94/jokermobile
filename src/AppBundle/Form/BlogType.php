<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Naslov',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('img1', FileType::class, array(
                'data_class' => null,
                'label' => 'Naslovna slika',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('img2', FileType::class, array(
                'data_class' => null,
                'label' => 'Tekst slika',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('contentTxt', TextareaType::class, array(
                'label' => 'Tekst',
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'resize: none;'
                )
            ))
            ->add('createdFrom', null, array(
                'label' => 'Autor | Preuzeto sa',
                'attr' => array(
                    'class' => 'form-control'
                )
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Blog'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_blog';
    }


}
