<?php

namespace Intrix\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeguimentoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nome', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Seguimento',
                ))
                ->add('descricao', 'textarea', array(
                    'label' => 'Descrição',
                    'attr' => array(
                        'rows' => '5',
                        'cols' => '5',
                        'class' => 'form-control'
                    ))
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Intrix\BackendBundle\Entity\Seguimento',
            'attr' => array(
                'class' => 'form-horizontal',
                'role' => 'form',
                'titulo' => 'Seguimento'
            ),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'intrix_backendbundle_seguimento';
    }

}
