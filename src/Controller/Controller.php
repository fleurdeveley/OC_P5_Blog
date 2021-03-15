<?php

namespace Blog\Controller;

use Twig\Loader\FilesystemLoader;

class Controller
{
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('../src/View');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
    }
}