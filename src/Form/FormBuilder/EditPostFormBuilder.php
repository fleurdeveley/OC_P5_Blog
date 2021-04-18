<?php

namespace Blog\Form\FormBuilder;

use Blog\Form\Field\SelectField;
use Blog\Form\Field\TextareaField;
use Blog\Form\Field\TextField;
use Blog\Form\Validator\MaxLengthValidator;
use Blog\Form\Validator\NotNullValidator;
use Blog\Model\Model;

/**
 * Class EditPostFormBuilder
 */

class EditPostFormBuilder extends FormBuilder
{
    protected $categories;

    public function __construct(Model $model, array $categories)
    {
        $this->categories = $categories;

        parent::__construct($model);
    }

    public function build()
    {
        $this->form->add(new TextField([
            'label' => 'Titre',
            'name' => 'title',
            'validators' => [
                new NotNullValidator('Merci de modifier le titre.'),
            ],
        ]))
            ->add(new SelectField([
                'label' => 'Catégorie',
                'name' => 'category_id',
                'options' => $this->categories,
                'validators' => [
                    new NotNullValidator('Merci de sélection une catégorie.')
                ]
            ]))
            ->add(new TextareaField([
                'label' => 'Chapo',
                'name' => 'chapo',
                'maxLength' => 255,
                'validators' => [
                    new NotNullValidator('Merci de modifier résumé.'),
                    new MaxLengthValidator('Le résumé est trop long : 255 caractères maximum.',
                        255)
                ]
            ]))
            ->add(new TextareaField([
                'label' => 'Contenu',
                'name' => 'content',
                'rows' => 15,
                'validators' => [
                    new NotNullValidator('Merci de modifier le contenu.')
                ]
            ]))
            ->add(new TextField([
                'label' => 'Image',
                'name' => 'picture',
                'validators' => [
                    new NotNullValidator('Merci de modifier la picture.')
                ]
            ]));
    }
}