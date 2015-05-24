<?php

namespace Main\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "comentario")
 *
 * @author Ana Paula Binda <anapaulasif@unochapeco.edu.br>
 * @category Main
 * @package Entity
 */
class Comentario 
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
    protected $email;

    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $comentario;

    /**
     * @ORM\ManyToOne(targetEntity="Comentario")
     * @ORM\JoinColumn(name="id_post", referencedColumnName="id")
     *
     * @var \Admin\Model\Post
     */
    protected $post;

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
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getComentario() {
        return $this->comentario;
    }

    /**
     * @param string $comentario
     */
    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    /**
     * @return Post
     */
    public function getPost() {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost($post) {
        $this->post = $post;
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
                        'name' => 'comentario',
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
                        'name' => 'post',
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
