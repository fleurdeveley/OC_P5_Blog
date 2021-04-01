<?php

namespace Blog\Form\FormBuilder;

use Blog\Form\Form;
use Blog\Model\Model;

/**
 * Class FormBuilder
 */

abstract class FormBuilder
{
    protected $form;

    /**
     * FormBuilder constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->setForm(new Form($model));
    }

    /**
     * @return mixed
     */
    abstract public function build();

    /**
     * @param Form $form
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    /**
     * @return mixed
     */
    public function form()
    {
        return $this->form;
    }
}