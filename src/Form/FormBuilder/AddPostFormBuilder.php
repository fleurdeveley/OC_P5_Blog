<?php

namespace Blog\Form\FormBuilder;

use Blog\Form\Field\TextareaField;
use Blog\Form\Field\TextField;
use Blog\Form\Validator\NotNullValidator;

/**
 * Class AddPostFormBuilder
 */

class AddPostFormBuilder extends FormBuilder
{
    public function build()
    {
        //add category avec un selectfield
        //add user avec récupération de l'id stocké dans la session

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