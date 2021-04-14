<?php

namespace Blog\Controller;

use Blog\Form\FormBuilder\RegisterFormBuilder;
use Blog\Form\FormHandler;
use Blog\Model\User;
use Blog\Model\UserManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class HomeController
 * return login view
 */

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function login(Request $request)
    {
        $userManager = new UserManager();

        if($request->getMethod() == 'POST') {
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            $password = md5($password);

            $user = $userManager->oneByEmail($email);

            if($email == $user->getEmail() && $password == $user->getPassword()){
                $this->session->set('auth', true);
                $this->session->set('user_id', $user->getId());

                return new RedirectResponse('administrateur');
            } else {
                $this->session->getFlashBag()->add('error', 'Identifiants incorrects');
            }
        }

        return new Response($this->twig->render('Frontend/login.twig'));
    }

    /**
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function register(Request $request): Response
    {
        $userManager = new UserManager();

        if($request->getMethod() == 'POST') {
            $user = new User([
                'firstname' => $request->request->get('firstname'),
                'lastname' => $request->request->get('lastname'),
                'email' => $request->request->get('email'),
                'password' => $request->request->get('password')
            ]);
        } else {
            $user = new User;
        }

        $formBuilder = new RegisterFormBuilder($user);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $userManager, $request);

        $userBdd = $userManager->oneByEmail($user->getEmail());

        if($user->getEmail() != $userBdd->getEmail()) {
            if($formHandler->process()) {
                return new RedirectResponse('/login');
            }
        }

        if($user->getEmail() &&  $user->getEmail() == $userBdd->getEmail()) {
            $this->session->getFlashBag()->add('error-register', 'Vous êtes déjà inscrit.');
        }

        return new Response($this->twig->render('Frontend/register.twig',
            [
                'user' => $user,
                'form' => $form->createView()
            ]
        ));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $this->session->invalidate();

        return new RedirectResponse('login');
    }
}