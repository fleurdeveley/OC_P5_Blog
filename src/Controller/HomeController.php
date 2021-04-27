<?php

namespace Blog\Controller;

use Blog\Form\FormBuilder\ContactFormBuilder;
use Blog\Form\FormHandler;
use Blog\Model\Contact;
use Blog\Model\ContactManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class HomeController
 * return home view
 */

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function home(Request $request): Response
    {
        $contactManager = new ContactManager();

        if($request->getMethod() == 'POST') {
            $contact = new Contact([
                'lastname' => $request->request->get('lastname'),
                'firstname' => $request->request->get('firstname'),
                'email' => $request->request->get('email'),
                'message' => $request->request->get('message'),
            ]);
        } else {
            $contact = new Contact;
        }

        $formBuilder = new ContactFormBuilder($contact);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $contactManager, $request);

        if($formHandler->process()) {
            $this->session->getFlashBag()->add('contact', 'Le formulaire de contact 
            a été envoyé avec succes !');
        }

        return new Response($this->twig->render('Frontend/home.twig',
            [
                'form' => $form->createView()
            ]
        ));
    }
}
