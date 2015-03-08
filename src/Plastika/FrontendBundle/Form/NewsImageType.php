<?php

namespace Plastika\FrontendBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsImageType extends AbstractType{
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('image', 'file', array('label' => 'Фото', 'required' => false));
    }

    public function getName()
    {
        return 'news_image';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Plastika\BusinessBundle\Entity\NewsImage',
            'csrf_protection' => false,
        ));
    }
} 