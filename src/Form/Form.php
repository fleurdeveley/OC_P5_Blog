<?php

namespace Blog\Form;

use Blog\Form\Field\Field;
use Blog\Model\Model;

/**
 * Class Form
 */

class Form
{
    protected $model;
    protected $fields = [];

    /**
     * Form constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->setModel($model);
    }

    /**
     * @param Field $field
     * @return $this
     */
    public function add(Field $field): Form
    {
        $attr = $field->getName();
        $attr = str_replace('_', '', ucwords($attr, '_'));
        $method = 'get'.ucfirst($attr);
        $field->setValue($this->model->$method());

        $this->fields[] = $field;
        return $this;
    }

    /**
     * @return string
     */
    public function createView(): string
    {
        $view = '';
        foreach($this->fields as $field) {
            $view .= $field->buildWidget();
        }
        return $view;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $valid = true;

        foreach($this->fields as $field) {
            if(!$field->isValid()) {
                $valid = false;
            }
        }
        return $valid;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }
}