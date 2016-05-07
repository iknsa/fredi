<?php

namespace fredi\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FloatType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use fredi\AppBundle\Form\CostType;

class CostLineType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cost', CostType::class, array('required' => false, 'label' => false))
            ->add('cityStart', TextType::class)
            ->add('cityEnd', TextType::class)
            ->add('distance', TextType::class)
            ->add('toll', TextType::class)
            ->add('meal', TextType::class)
            ->add('accommodation', TextType::class)
            ->add('isvalid', CheckBoxType::class, array(
                'required' => false,
            ));

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $event->stopPropagation();
        }, 900);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fredi\AppBundle\Entity\CostLine'
        ));
    }
}
