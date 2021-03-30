<?php

namespace Blog\Form\FormBuilder;

use Blog\Form\Form;
use Blog\Model\Model;

abstract class FormBuilder
{
    protected $form;

    public function __construct(Model $model)
    {
        $this->setForm(new Form($model));
    }

    abstract public function build();

    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    public function form()
    {
        return $this->form;
    }
}