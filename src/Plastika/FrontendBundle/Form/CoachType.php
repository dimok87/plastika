<?php

namespace Plastika\FrontendBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CoachType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array('attr' => array('class'=>'form-control')));
        $builder->add('image', 'file', array('label' => 'Фото тренера', 'required' => false));
        $builder->add('fullText', 'textarea', array('attr' => array('class'=>'form-control tinymce')));
        $builder->add('images', 'collection', array(
            'type' => new CoachImageType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            'required' => false,
        ));
        $builder->add('video', 'collection', array(
            'type' => new CoachVideoType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            'required' => false,
        ));
        $builder->add('documents', 'collection', array(
            'type' => new CoachDocumentType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            'required' => false,
        ));
    }

    public function getName()
    {
        return 'coach';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Plastika\BusinessBundle\Entity\Coach',
            'csrf_protection' => false,
        ));
    }
}