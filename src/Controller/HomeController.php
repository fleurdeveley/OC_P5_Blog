<?php

namespace Blog\Controller;

use Twig\Loader\FilesystemLoader;

class HomeController {

    public function home() {

        $loader = new FilesystemLoader('../src/View');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        return $twig->render('Frontend/home.twig');
    }

}
