<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "usuario")
 *
 * @author Ana Paula Binda <anapaulasif@unochapeco.edu.br>
 * @category Admin
 * @package Entity
 */
class Usuario 
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $id;
    
    protected $inputFilter;

    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $nome;

    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column (type="date")
     *
     * @var string
     */
    protected $data_nasc;

    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $perfil;

    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $login;

    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $senha;

    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $role;

    /**
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getDataNasc() {
        return $this->data_nasc;
    }

    /**
     * @param string $data_nasc
     */
    public function setDataNasc($data_nasc) {
        $this->data_nasc = $data_nasc;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPerfil() {
        return $this->perfil;
    }

    /**
     * @param string $perfil
     */
    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    /**
     * @return string
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * @param string $perfil
     */
    public function setLogin($login) {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getSenha() {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    /**
     * @return string
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @return array
     */
    public function getArrayCopy() {
        return get_object_vars($this);
    }

    /**
     *
     * @return Zend/InputFilter/InputFilter
     */
    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            $inputFilter->add($factory->createInput(array(
                        'name' => 'id',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));
            $inputFilter->add(
                    $factory->createInput(array(
                        'name' => 'login',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                            array('name' => 'StringToLower',
                                'options' => array('encoding' => 'UTF-8')
                            ),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => '1',
                                    'max' => '100',
                                ),
                            ),
                        ),
                    ))
            );
            $inputFilter->add(
                    $factory->createInput(array(
                        'name' => 'senha',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => '1',
                                    'max' => '255',
                                ),
                            ),
                        ),
                    ))
            );
            $inputFilter->add(
                    $factory->createInput(array(
                        'name' => 'role',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => '1',
                                    'max' => '100',
                                ),
                            ),
                        ),
                    ))
            );

            $inputFilter->add($factory->createInput(array(
                        'name' => 'nome',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array('message' => 'O campo Nome não pode estar vazio')
                            ),
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 3,
                                    'max' => 255,
                                    'message' => 'O campo nome deve ter mais que 3 caracteres e menos que 255',
                                ),
                            ),
                        ),
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                            array('name' => 'StringToUpper',
                                'options' => array('encoding' => 'UTF-8')
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'email',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array('message' => 'O campo E-mail não pode estar vazio')
                            ),
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 3,
                                    'max' => 255,
                                    'message' => 'O campo E-mail deve ter mais que 3 caracteres e menos que 255',
                                ),
                            ),
                            array(
                                'name' => 'EmailAddress',
                                'options' => array('message' => 'Não parece ser um e-mail válido')
                            ),
                        ),
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                            array('name' => 'StringToLower',
                                'options' => array('encoding' => 'UTF-8')
                            ),
                        ),
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'perfil',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array('message' => 'O campo perfil não pode estar vazio')
                            ),
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 3,
                                    'max' => 255,
                                    'message' => 'O campo perfil deve ter mais que 3 caracteres e menos que 255',
                                ),
                            ),
                        ),
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                            array('name' => 'StringToUpper',
                                'options' => array('encoding' => 'UTF-8')
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'data_nasc',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'Date',
                                'options' => array(
                                    'message' => 'Não parece uma data válida',
                                    'format' => 'd-m-Y'
                                )
                            ),
                        ),
            )));

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

}
