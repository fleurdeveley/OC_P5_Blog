<?php

namespace Blog\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller {

    public function home(Request $request) {

        return new Response($this->twig->render('Frontend/home.twig'));
    }
}
