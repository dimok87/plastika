<?php

namespace Plastika\FrontendBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AchieveType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array('attr' => array('class'=>'form-control')));
        $builder->add('fullText', 'textarea', array('attr' => array('class'=>'form-control tinymce')));
        $builder->add('achieved', 'text', array('attr' => array('class'=>'form-control')));
        $builder->add('images', 'collection', array(
            'type' => new AchieveImageType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            'required' => false,
        ));
        $builder->add('video', 'collection', array(
            'type' => new AchieveVideoType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            'required' => false,
        ));
    }

    public function getName()
    {
        return 'achieve';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Plastika\BusinessBundle\Entity\Achieve',
            'csrf_protection' => false,
        ));
    }
}