<?php

namespace Blog\Form\FormBuilder;

use Blog\Form\Field\EmailField;
use Blog\Form\Field\PasswordField;
use Blog\Form\Field\TextField;
use Blog\Form\Validator\MaxLengthValidator;
use Blog\Form\Validator\NotNullValidator;

/**
 * Class RegisterFormBuilder
 */

class RegisterFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new TextField([
            'label' => 'Prénom',
            'name' => 'firstname',
            'validators' => [
                new NotNullValidator('Merci de saisir votre nom.'),
            ],
        ]))
            ->add(new TextField([
                'label' => 'Nom',
                'name' => 'lastname',
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
            ->add(new PasswordField([
                'label' => 'Mot de passe',
                'name' => 'password',
                'maxLength' => 8,
                'validators' => [
                    new MaxLengthValidator('Le mot de passe spécifié est trop long : 
                    8 caractères maximum.',8),
                    new NotNullValidator('Merci de saisir votre mot de passe.')
                ]
            ]));
    }

}