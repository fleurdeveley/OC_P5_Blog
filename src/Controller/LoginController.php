<?php

namespace Blog\Controller;

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

                return new RedirectResponse('administrateur');
            } else {
                $this->session->getFlashBag()->add('error', 'Identifiants incorrects');
            }
        }

        return new Response($this->twig->render('Frontend/login.twig'));
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