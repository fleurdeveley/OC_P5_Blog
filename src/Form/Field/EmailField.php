<?php

namespace Blog\Form\Field;

/**
 * Class EmailField
 */

class EmailField extends Field
{
    /**
     * @return string
     */
    public function buildWidget(): string
    {
        $widget = '<div class="form-group">';

        $widget .= '<label for="'.$this->name.'">'.$this->label.'</label>
                    <input type="email" id="'.$this->name.'" name="'.$this->name.'" class="form-control border-dark"';

        if(!empty($this->value)) {
            $widget .= ' value="'.htmlspecialchars($this->value).'"';
        }

        $widget .= ' />';

        if (!empty($this->errorMessage))
        {
            $widget .= '<div class="alert alert-danger">' . $this->errorMessage. '</div>';
        }

        $widget .= '</div>';

        return $widget;
    }
}