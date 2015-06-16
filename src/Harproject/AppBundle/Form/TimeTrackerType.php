<?php

namespace Harproject\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TimeTrackerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created_at')
            ->add('finished_at')
            ->add('comment')
            ->add('memberHasTasks')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Harproject\AppBundle\Entity\TimeTracker'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'harproject_appbundle_timetracker';
    }
}