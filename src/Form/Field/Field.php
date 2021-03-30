<?php

namespace Blog\Form\Field;

use Blog\Form\Validator\Validator;
use Blog\Hydrator;

/**
 * Class Field
 */
abstract class Field
{
    use Hydrator;

    protected $errorMessage;
    protected $label;
    protected $length;
    protected $name;
    protected $validators = [];
    protected $value;

    /**
     * Field constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    /**
     * @return mixed
     */
    abstract public function buildWidget();

    public function isValid(): bool
    {
        foreach($this->validators as $validator) {
            if(!$validator->isValid($this->value)) {
                $this->errorMessage = $validator->errorMessage();
                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param $length
     */
    public function setLength($length)
    {
        $length = (int) $length;

        if($length >0) {
            $this->length = $length;
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getValidators()
    {
        return $this->validators;
    }

    public function setValidators(array $validators)
    {
        foreach($validators as $validator) {
            if($validator instanceof Validator && !in_array($validator, $this->validators)){
                $this->validators[] = $validator;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}