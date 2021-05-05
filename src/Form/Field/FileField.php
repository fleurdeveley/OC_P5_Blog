<?php

namespace Blog\Form\Field;

/**
 * Class FileField
 */

class FileField extends Field
{
    /**
     * @return string
     */
    public function buildWidget(): string
    {

        $widget = '<div class="mb-3">';

        $widget .= '<label for="'.$this->name.'" class="custom-file-label">'.$this->label.'</label>
                    <input type="file" id="'.$this->name.'" name="'.$this->name.'" class="form-control form-control-lg"';

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