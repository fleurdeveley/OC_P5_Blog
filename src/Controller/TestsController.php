<?php

namespace Blog\Controller;

use Blog\Form\Field\TextareaField;
use Blog\Form\Field\TextField;
use Blog\Form\Form;
use Blog\Model\Comment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestsController extends Controller
{
    public function tests(Request $request)
    {
        $comment = new Comment();

        $form =new Form($comment);

        $form->add(new TextField([
            'label' => 'Auteur',
            'name' => 'author',
            'maxLength' => 30,
        ]))
        ->add(new TextareaField([
            'label' => 'Commentaires',
            'name' => 'content',
        ]));

        if ($form->isValid()) {
            //enregistrer le commentaire
        }
        return new response($form-> createView());
    }
}