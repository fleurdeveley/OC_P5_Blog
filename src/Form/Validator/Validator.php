<?php

namespace Blog\Form\Validator;

/**
 * Class Validator
 */

abstract class Validator
{
    protected $errorMessage;

    /**
     * Validator constructor.
     * @param $errorMessage
     */
    public function __construct($errorMessage)
    {
        $this->setErrorMessage($errorMessage);
    }

    /**
     * @param $value
     * @return mixed
     */
    abstract public function isValid($value);

    /**
     * @param $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        if(is_string($errorMessage)) {
            $this->errorMessage = $errorMessage;
        }
    }

    /**
     * @return mixed
     */
    public function errorMessage()
    {
        return $this->errorMessage;
    }
}