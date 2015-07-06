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
                    'empty_value' => 'Escolha um seguimento...',
                    'class' => 'BackendBundle:Seguimento',
                    'property' => 'nome',
                    'attr' => array(
                        'data-placeholder' => 'Escolha um seguimento...',
                        'class' => 'select-search',
                        'tabindex' => '2'
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
                'titulo' => 'Dados cadastrais de uma empresa'
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
