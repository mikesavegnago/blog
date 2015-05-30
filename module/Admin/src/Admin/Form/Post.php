<?php


/**
 * Formulario 
 * 
 * @Author Paulo Cella <paulocella@unochapeco.edu.br>
 * 
 */

namespace Admin\Form;

use Zend\Form\Form as Form;
use Zend\Form\Element;

class Post extends Form {

    public function __construct($em) 
    {
        parent::__construct('post');
        $this->setAttribute('action','');
        $this->setAttribute('method', 'post');

        $this->add(
                array(
                    'name' => 'id',
                    'type' => 'hidden',
                )
        );

        $this->add(array(
            'name' => 'titulo',
            'type' => 'text',
            'options' => array(
                'label' => 'Titulo:',
            ),
            'attributes' => array(
                'placeholder' => 'Informe o titulo do Post',
                'id' => 'titulo',
                'class' => 'form-control'
            )
        ));

        $this->add(array(
            'name' => 'minText',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Texto:'
            ),
            'attributes' => array(
                'placeholder' => 'Informe o corpo do post',
                'id' => 'minText',
                'class' => 'form-control'
            )
        ));

        $this->add(array(
            'name' => 'postComp',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Post Completo:'
            ),
            'attributes' => array(
                'placeholder' => 'Informe post Completo',
                'id' => 'postComp',
                'class' => 'form-control'
            )
        ));

        $this->add(array(
            'name' => 'ativo',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Ativo'
            ),
            'attributes' => array(
                'placeholder' => 'Informe se o usuario é ativo',
                'id' => 'ativo'
            )
        ));


        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
                )
            ));
    }

}
