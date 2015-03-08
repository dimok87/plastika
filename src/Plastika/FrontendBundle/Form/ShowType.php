<?php

namespace Plastika\FrontendBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ShowType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array('attr' => array('class'=>'form-control')));
        $builder->add('fullText', 'textarea', array('attr' => array('class'=>'form-control tinymce')));
        $builder->add('price', 'text', array('attr' => array('class'=>'form-control')));
    }

    public function getName()
    {
        return 'show';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Plastika\BusinessBundle\Entity\Show',
            'csrf_protection' => false,
        ));
    }
}