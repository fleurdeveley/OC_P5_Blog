<?php

namespace Blog\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AdministratorController
 * return administrator view
 */

class AdministratorController extends Controller
{
    /**
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function administrator(): Response
    {
        if($this->session->get('auth')) {
            return new Response($this->twig->render('Backend/administrator.twig'));
        } else {
            return new RedirectResponse('login');
        }
    }
}