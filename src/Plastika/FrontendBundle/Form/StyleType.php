<?php

namespace Plastika\FrontendBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StyleType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array('attr' => array('class'=>'form-control')));
        $builder->add('fullText', 'textarea', array('attr' => array('class'=>'form-control tinymce')));
        $builder->add('price', 'text', array('attr' => array('class'=>'form-control')));
        $builder->add('images', 'collection', array(
            'type' => new StyleImageType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            'required' => false,
        ));
        $builder->add('coaches', 'entity', array(
            'class' => 'PlastikaBusinessBundle:Coach',
            'property' => 'title',
            'multiple' => true,
            'expanded' => true,
        ));
    }

    public function getName()
    {
        return 'style';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Plastika\BusinessBundle\Entity\Style',
            'csrf_protection' => false,
        ));
    }
}