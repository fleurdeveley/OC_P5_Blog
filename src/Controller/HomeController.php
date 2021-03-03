<?php

namespace Blog\Controller;

use Twig\Loader\FilesystemLoader;

class HomeController {

    public function home() {

        $loader = new FilesystemLoader('../src/View');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        echo $twig->render('Frontend/home.twig');
    }

}
