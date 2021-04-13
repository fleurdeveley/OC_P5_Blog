<?php

namespace Blog\Form\Field;

/**
 * Class TextareaField
 */

class TextareaField extends Field
{
    protected $cols;
    protected $rows;

    /**
     * @return string
     */
    public function buildWidget(): string
    {
        $widget = '<div class="form-group">';

        $widget .= '<label for="'.$this->name.'">'.$this->label.'</label>
                    <span name="'.$this->name.'" id="'.$this->name.'"class="textarea" role="textbox" contenteditable>';

        if(!empty($this->value)) {
            $widget .= htmlspecialchars($this->value);
        }

        $widget .= '</span>';

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