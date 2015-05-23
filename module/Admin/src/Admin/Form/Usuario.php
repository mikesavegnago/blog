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

class Usuario extends Form
{
	
	public function __construct(\Doctrine\ORM\EntityManager $em)
	{
		parent::__construct('usuario');
		$this->setAttribute('action', '');
		$this->setAttribute('method', 'post');
		
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
				'id' => 'nome'
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
				'id' => 'email'
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
				'id' => 'data_nasc'
				)
			));
                
		$this->add(array(
			'name' => 'perfil',
			'type' => 'text',
			'options' => array(
				'label' => 'Perfil:'
				),
			'attributes' => array(
				'placeholder' => 'Informe o perfil',
				'id' => 'perfil'
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
				'id' => 'login'
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
				'id' => 'senha'
				)
			));
                
                $this->add(array(
                    'name'=>'role',
                    'type' => 'select',
                    'options' => array(
                        'label' => 'perfil:*',
                        'value_options' => array('CATALOGADOR'=>'CATALOGADOR','ADMIN'=>'ADMIN')
                    ),
                    'attributes' => array(
                        'class' => 'form-control'
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