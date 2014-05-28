<?php

namespace Formation\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Formation\ModelBundle\Form\ArticleType;

class ComType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author','text')
            ->add('text','text')
            ->add('datePubication','date')
            ->add('isDelete','checkbox',array('required'  => false))
            //->add('user')     //sera vu avec la gestion des user
            ->add('article','entity',array('class'=>'FormationModelBundle:Article','property'=>'name','multiple'=>false))
            ->add('Ok','submit')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Formation\ModelBundle\Entity\Com'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'formation_modelbundle_com';
    }
}
