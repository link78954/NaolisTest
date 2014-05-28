<?php

namespace Formation\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CatType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('isActive')
            ->add('dateCreation')
            //->add('user')
            ->add('articles','entity',array('class'=>'FormationModelBundle:Article','property'=>'name','multiple'=>true))
            ->add('Ok','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Formation\ModelBundle\Entity\Cat'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'formation_modelbundle_cat';
    }
}
