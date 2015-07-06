<?php

namespace Intrix\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('seguimento', 'entity', array(
                    'empty_value' => 'Selecione...',
                    'class' => 'BackendBundle:Seguimento',
                    'property' => 'nome',
                    'attr' => array(
                        'placeholder' => 'Escolha um seguimento...',
                        'class' => 'select',
                        'tabindex' => '8'
                    ),
                    'label' => 'Seguimento',
                ))
                ->add('nome', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Empresa',
                ))
                ->add('telefone', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Telefone',
                ))
                ->add('site', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Site',
                ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Intrix\BackendBundle\Entity\Empresa',
            'attr' => array(
                'class' => 'form-horizontal',
                'role' => 'form',
                'titulo' => 'Empresa'
            ),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'intrix_backendbundle_empresa';
    }

}
