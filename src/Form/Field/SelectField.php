<?php

namespace Blog\Form\Field;

/**
 * Class SelectField
 */

class SelectField extends Field
{
    protected $options;

    /**
     * @return string
     */
    public function buildWidget(): string
    {
        $widget = '<label for="'.$this->name.'">'.$this->label.'</label>
        <select class="form-select"  name="'.$this->name.'" aria-label="Default select example">';

        foreach ($this->options as $value => $name) {
            $widget .= '<option value="'. $value .'">' . $name . '</option>';
        }

        if (!empty($this->errorMessage))
        {
            $widget .= '<div class="alert alert-danger">' . $this->errorMessage. '</div>';
        }

        $widget .= '</select>';

        return $widget;
    }

    /**
     * @param mixed $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }
}