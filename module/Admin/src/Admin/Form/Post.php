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

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct('post');
        $this->setAtribute('action', '');
        $this->setAtribute('method', 'post');

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
                'id' => 'titulo'
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
                'id' => 'minText'
            )
        ));

        $this->add(array(
            'name' => 'postComp',
            'type' => 'text',
            'options' => array(
                'label' => 'PostComp:'
            ),
            'attribtes' => array(
                'placeholder' => 'Informe post Comp',
                'id' => 'postComp'
            )
        ));

        $this->add(array(
            'name' => 'ativo',
            'type' => 'creckbox',
            'options' => array(
                'label' => 'Ativo:'
            ),
            'attributes' => array(
                'placeholder' => 'Informe se o usuario é ativo',
                'id' => 'ativo'
            )
        ));
    }

}
