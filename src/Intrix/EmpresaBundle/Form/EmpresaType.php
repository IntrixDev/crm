<?php

namespace Intrix\EmpresaBundle\Form;

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
                    'class' => 'EmpresaBundle:Seguimento',
                    'property' => 'nome',
                    'attr' => array(
                        'data-placeholder' => 'Escolha um seguimento...',
                        'class' => 'select-search',
                        'tabindex' => '2',
                        'modal_form' => 'Adicionar novo seguimento'
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
                ))
                ->add('observacao', 'textarea', array(
                    'label' => 'Observação',
                    'attr' => array(
                        'rows' => '5',
                        'cols' => '5',
                        'class' => 'form-control'
                    )
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Intrix\EmpresaBundle\Entity\Empresa',
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
        return 'intrix_empresabundle_empresa';
    }

}
