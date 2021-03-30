<?php

namespace Blog\Form\FormBuilder;


use Blog\Form\Field\TextareaField;
use Blog\Form\Field\TextField;
use Blog\Form\Validator\MaxLengthValidator;
use Blog\Form\Validator\NotNullValidator;

class CommentFormBuilder extends FormBuilder{
    public function build()
    {
        $this->form->add(new TextField([
            'label' => 'Auteur',
            'name' => 'author',
            'maxLength' => 30,
            'validators' => [
                new MaxLengthValidator('L\'auteur spécifié est trop long (30 caractères maximum.', 30),
                new NotNullValidator('Merci de saisir l\'auteur du commentaire.'),
            ],
        ]))
            ->add(new TextareaField([
                'label' => 'Commentaires',
                'name' => 'content',
                'validators' => [
                    new NotNullValidator('Merci de saisir votre commentaire.')
                ]
            ]));
    }
}