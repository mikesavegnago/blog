<?php

/**
 * Formulario 
 * 
 * @Author Paulo Cella <paulocella@unochapeco.edu.br>
 * 
 */

namespace Admin\Form;

use \Zend\Form\Form as Form;
use \Zend\Form\Element;

class Usuario extends Form {

    public function __construct($em) {
        parent::__construct('usuario');
        $this->setAttribute('action', '');
        $this->setAttribute('method', 'POST');

        $this->add(
                array(
                    'name' => 'id',
                    'type' => 'hidden',
                )
        );

        $this->add(array(
            'name' => 'nome',
            'type' => 'text',
            'options' => array(
                'label' => 'Nome:'
            ),
            'attributes' => array(
                'placeholder' => 'Informe o nome',
                'id' => 'nome',
                'class' => 'form-control'
            )
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'text',
            'options' => array(
                'label' => 'E-mail:'
            ),
            'attributes' => array(
                'placeholder' => 'Informe o e-mail',
                'id' => 'email',
                'class' => 'form-control'
            )
        ));




        $this->add(array(
            'name' => 'data_nasc',
            'type' => 'date',
            'options' => array(
                'label' => 'Data nascimento'
            ),
            'attributes' => array(
                'placeholder' => 'Informe sua data de nascimento',
                'id' => 'data_nasc',
                'class' => 'form-control'
            )
        ));

        $this->add(array(
            'name' => 'perfil',
            'type' => 'select',
            'options' => array(
                'label' => 'Perfil:*',
                'value_options' => array('EDITOR' => 'EDITOR', 'VISITANTE' => 'VISITANTE', 'ADMIN' => 'ADMIN')
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));


        $this->add(array(
            'name' => 'login',
            'type' => 'text',
            'options' => array(
                'label' => 'Login:'
            ),
            'attributes' => array(
                'placeholder' => 'Informe o Login',
                'id' => 'login',
                'class' => 'form-control'
            )
        ));


        $this->add(array(
            'name' => 'senha',
            'type' => 'password',
            'options' => array(
                'label' => 'Senha:'
            ),
            'attributes' => array(
                'placeholder' => 'Informe senha',
                'id' => 'senha',
                'class' => 'form-control'
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
