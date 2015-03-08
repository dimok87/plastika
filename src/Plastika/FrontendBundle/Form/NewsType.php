<?php

namespace Plastika\FrontendBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array('attr' => array('class'=>'form-control')));
        $builder->add('fullText', 'textarea', array('attr' => array('class'=>'form-control tinymce')));
        $builder->add('images', 'collection', array(
            'type' => new NewsImageType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            'required' => false,
        ));
        $builder->add('video', 'collection', array(
            'type' => new NewsVideoType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            'required' => false,
        ));
    }

    public function getName()
    {
        return 'news';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Plastika\BusinessBundle\Entity\News',
            'csrf_protection' => false,
        ));
    }
}