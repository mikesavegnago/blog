<?php

/**
 * Formulario 
 * 
 * @Author Paulo Cella <paulocella@unochapeco.edu.br>
 * 
 */

namespace Main\Form;

use \Zend\Form\Form as Form;
use \Zend\Form\Element;

class Comentario extends Form {

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct('comentario');
        $this->setAttribute('action', '');
        $this->setAttribute('method', 'post');

        $this->add(
                array(
                    'name' => 'id',
                    'type' => 'hidden',
                )
        );
        $this->add(
                array(
                    'name' => 'post',
                    'type' => 'text',
                )
        );


        $this->add(array(
            'name' => 'email',
            'type' => 'text',
            'options' => array(
                'label' => 'Email:'
            ),
            'attributes' => array(
                'placeholder' => 'Informe o Email',
                'id' => 'email'
            )
        ));

        $this->add(array(
            'name' => 'comentario',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Comentario:'
            ),
            'attributes' => array(
                'placeholder' => 'Informe Comentario',
                'id' => 'comentario',
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Salvar'
            )
        ));
    }

}

?>