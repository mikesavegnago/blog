<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "post")
 *
 * @author Ana Paula Binda <anapaulasif@unochapeco.edu.br>
 * @category Admin
 * @package Entity
 */
class Post 
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
    protected $titulo;

    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $minText;

    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $postComp;

    /**
     * @ORM\Column (type="integer")
     *
     * @var integer
     */
    protected $ativo;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     *
     * @var \Admin\Entity\Usuario
     */
    protected $usuario;

    /**
     * @return string
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    /**
     * @return string
     */
    public function getMinText() {
        return $this->minText;
    }

    /**
     * @param string $minText
     */
    public function setMinText($minText) {
        $this->minText = $minText;
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
    public function getPostComp() {
        return $this->postComp;
    }

    /**
     * @param string $postComp
     */
    public function setPostComp($postComp) {
        $this->postComp = $postComp;
    }

    /**
     * @return integer
     */
    public function getAtivo() {
        return $this->ativo;
    }

    /**
     * @param string $ativo
     */
    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    /**
     * @return Usuario
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
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

            $inputFilter->add($factory->createInput(array(
                        'name' => 'titulo',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array('message' => 'O campo titulo não pode estar vazio')
                            ),
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 3,
                                    'max' => 255,
                                    'message' => 'O campo titulo deve ter mais que 3 caracteres e menos que 255',
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
                        'name' => 'minText',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array('message' => 'O campo minText não pode estar vazio')
                            ),
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 3,
                                    'max' => 255,
                                    'message' => 'O campo minText deve ter mais que 3 caracteres e menos que 255',
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
                        'name' => 'postComp',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array('message' => 'O campo postComp não pode estar vazio')
                            ),
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 3,
                                    'max' => 255,
                                    'message' => 'O campo postComp deve ter mais que 3 caracteres e menos que 255',
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
                        'name' => 'ativo',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'Integer',
                            ),
            ))));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'usuario',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array('message' => 'O campo Usuario não pode estar vazio')
                            )
                        ),
            )));

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

}
