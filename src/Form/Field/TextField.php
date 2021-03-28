<?php

namespace Blog\Form\Field;

class TextField extends Field
{
    protected $maxLength;

    public function buildWidget()
    {

        $widget = '<div class="form-group">';

        $widget .= '<label for="'.$this->name.'">'.$this->label.'</label>
                    <input type="text" id="'.$this->name.'" name="'.$this->name.'" class="form-control border-dark"';

        if(!empty($this->value)) {
            $widget .= ' value="'.htmlspecialchars($this->value).'"';
        }

        if(!empty($this->maxLength)) {
            $widget .= ' maxLength="'.$this->maxLength.'"';
        }

        $widget .= ' />';

        $widget .= '</div>';

        return $widget;
    }

    public function setMaxLength($maxLength)
    {
        $maxLength = (int) $maxLength;

        if($maxLength > 0){
            $this->maxLength = $maxLength;
        } else {
            throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
        }
    }
}