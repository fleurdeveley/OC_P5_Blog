<?php

namespace Blog\Form\FormBuilder;

use Blog\Form\Field\TextareaField;
use Blog\Form\Field\TextField;
use Blog\Form\Validator\NotNullValidator;

/**
 * Class EditPostFormBuilder
 */

class EditPostFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new TextField([
            'label' => 'Titre',
            'name' => 'title',
            'validators' => [
                new NotNullValidator('Merci de modifier le titre.'),
            ],
        ]))
            ->add(new TextareaField([
                'label' => 'Chapo',
                'name' => 'chapo',
                'validators' => [
                    new NotNullValidator('Merci de modifier résumé.')
                ]
            ]))
            ->add(new TextareaField([
                'label' => 'Contenu',
                'name' => 'content',
                'rows' => 600,
                'cols' => 50,
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