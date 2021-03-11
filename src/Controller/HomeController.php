<?php

namespace Blog\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Loader\FilesystemLoader;

class HomeController {

    public function home(Request $request) {

        $loader = new FilesystemLoader('../src/View');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        return new Response($twig->render('Frontend/home.twig'));
    }

}
