<?php

namespace Blog\Form\Validator;

/**
 * Class NotNullValidator
 */

class NotNullValidator extends Validator
{
    /**
     * @param $value
     * @return bool
     */
    public function isValid($value): bool
    {
        return $value != '';
    }
}