<?php
namespace Core\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;

/**
 * Entity class
 * @package    Core\Model
 * @author     Cezar Junior de Souza <cezar08@unochapeco.edu.br>
 */
abstract class Entity implements InputFilterAwareInterface
{

    /**
    *
    *@var Zend\InputFilter\InputFilter
    */
    protected $input_filter;

    /**
     * @param InputFilterInterface $inputFilter
     * @return void
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new EntityException("Not used");
    }

    /**
     * Entity filters
     *
     * @return InputFilter
     */
    public function getInputFilter() 
    {
	}

    /**
     *
     * @return array
     */

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     *
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    protected function valid($key, $value)
    {
        if (! $this->getInputFilter())
            return $value;

        try {
            $filter = $this->getInputFilter()->get($key);
        }
        catch(InvalidArgumentException $e) {
            return $value;
        }    

        $filter->setValue($value);
        if(! $filter->isValid()) 
            throw new EntityException("Input inválido: $key = $value");

        return $filter->getValue($key);
    }
    
    /**
     * 
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}

