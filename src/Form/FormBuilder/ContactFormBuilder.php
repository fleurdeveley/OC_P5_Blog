<?php

namespace Blog\Form\FormBuilder;

use Blog\Form\Field\EmailField;
use Blog\Form\Field\TextareaField;
use Blog\Form\Field\TextField;
use Blog\Form\Validator\NotNullValidator;

/**
 * Class ContactFormBuilder
 */

class ContactFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new TextField([
            'label' => 'Nom',
            'name' => 'lastname',
            'validators' => [
                new NotNullValidator('Merci de saisir votre nom.'),
            ],
        ]))
            ->add(new TextField([
                'label' => 'Prénom',
                'name' => 'firstname',
                'validators' => [
                    new NotNullValidator('Merci de saisir votre prénom.'),
                ],
            ]))
            ->add(new EmailField([
                'label' => 'Email',
                'name' => 'email',
                'validators' => [
                    new NotNullValidator('Merci de saisir votre email.'),
                ],
            ]))
            ->add(new TextareaField([
                'label' => 'Message',
                'name' => 'message',
                'validators' => [
                    new NotNullValidator('Merci de saisir votre message.')
                ]
            ]));
    }
}