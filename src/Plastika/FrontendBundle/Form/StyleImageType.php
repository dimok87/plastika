<?php

namespace Plastika\FrontendBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StyleImageType extends AbstractType{
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('image', 'file', array('label' => 'Фото', 'required' => false));
    }

    public function getName()
    {
        return 'style_image';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Plastika\BusinessBundle\Entity\StyleImage',
            'csrf_protection' => false,
        ));
    }
} 