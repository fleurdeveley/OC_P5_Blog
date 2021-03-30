<?php

namespace Blog\Form\Field;

class TextareaField extends Field
{
    protected $cols;
    protected $rows;

    public function buildWidget()
    {

        $widget = '<div class="form-group">';

        $widget .= '<label for="'.$this->name.'">'.$this->label.'</label>
                    <textarea name="'.$this->name.'" id="'.$this->name.'" class="form-control border-secondary">';

        if(!empty($this->value)) {
            $widget .= htmlspecialchars($this->value);
        }

        $widget .= '</textarea>';

        if (!empty($this->errorMessage))
        {
            $widget .= '<div class="alert alert-danger">' . $this->errorMessage. '</div>';
        }

        $widget .= '</div>';

        return $widget;
    }

    /**
     * @param string $cols
     */
    public function setCols($cols)
    {
        $cols = (int) $cols;

        if($cols > 0) {
            $this->cols = $cols;
        }
    }

    /**
     * @param string $rows
     */
    public function setRows($rows)
    {
        $rows = (int) $rows;

        if($rows > 0) {
            $this->rows = $rows;
        }
    }
}