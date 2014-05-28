<?php

namespace Formation\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text')
            ->add('author','text')
            ->add('text','text')
            ->add('datePublicatione','date')
            ->add('isActive','checkbox')
//            ->add('user')
//            ->add('cats')
            ->add('cats','entity',array('class'=>'FormationModelBundle:Cat','property'=>'name','multiple'=>true))
            ->add('Ok','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Formation\ModelBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'formation_modelbundle_article';
    }
}
