<?php

namespace Intrix\ContatoBundle\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContatoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('empresa', 'entity', array(
                    'empty_value' => 'Escolha uma empresa...',
                    'class' => 'Intrix\EmpresaBundle\Entity\Empresa',
                    'property' => 'nome',
                    'attr' => array(
                        'data-placeholder' => 'Escolha uma empresa...',
                        'class' => 'select-search select-readonly',
                        'tabindex' => '2',
                    ),
                    'label' => 'Empresa',
                ))
                ->add('faleiCom', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Falei com',
                ))
                ->add('falarCom', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Falar com',
                ))
                ->add('telefone', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Telefone Direto',
                ))
                ->add('email', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'E-mail',
                ))
                ->add('envieiEmail', 'choice', array(
                    'attr' => array(
                        'class' => 'select',
                        'tabindex' => '2'
                    ),
                    'label' => 'Enviei email?',
                    'choices' => array(
                        '0' => 'Não',
                        '1' => 'Sim',
                    )
                ))
                ->add('interesse', 'choice', array(
                    'attr' => array(
                        'data-placeholder' => 'Escolha...',
                        'class' => 'select',
                        'tabindex' => '2'
                    ),
                    'label' => 'Existe o interesse?',
                    'choices' => array(
                        '' => 'Escolha...',
                        'Bastante' => 'Bastante',
                        'Pouco' => 'Pouco',
                        'Nenhum' => 'Nenhum',
                    )
                ))
                ->add('proximoContato', 'datetime', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'attr' => array('class' => 'form-control datetimepicker'),
                    'label' => 'Novo contato em?',
                ))
                ->add('observacao', 'textarea', array(
                    'label' => 'Observação',
                    'attr' => array(
                        'rows' => '5',
                        'cols' => '5',
                        'class' => 'form-control'
                    ))
                )
                ->addEventListener(FormEvents::PRE_BIND, function (FormEvent $event) {
                    $post = $event->getData();
                    $form = $event->getForm();

                    $form->add('proximoContato', 'datetime', array(
                        'widget' => 'single_text',
                        'input' => 'datetime',
                        'attr' => array('class' => 'form-control datetimepicker'),
                        'label' => 'Novo contato em?',
                    ));
                    
                    if (isset($post['proximoContato'])) {

                        list($data, $time) = explode(" ", $post['proximoContato']);
                        list($dia, $mes, $ano) = explode('/', $data);

                        $format = $ano . '-' . $mes . '-' . $dia . ' ' . $time . ':00';
                    }

                    $post['proximoContato'] = $format;

                    $event->setData($post);
                })
                ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                    $form = $event->getForm();

                    $form->add('proximoContato', 'datetime', array(
                        'widget' => 'single_text',
                        'format' => 'dd/MM/yyyy HH:mm',
                        'input' => 'datetime',
                        'attr' => array('class' => 'form-control datetimepicker'),
                        'label' => 'Novo contato em?',
                    ));
                });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Intrix\ContatoBundle\Entity\Contato',
            'attr' => array(
                'class' => 'form-horizontal',
                'role' => 'form',
                'titulo' => 'Dados do contato'
            ),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'intrix_contatobundle_contato';
    }

}
