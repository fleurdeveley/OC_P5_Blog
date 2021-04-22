<?php

namespace Blog\Controller;

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class Controller
 */

abstract class Controller
{
    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @var Session
     */
    protected $session;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader('../src/View');
        $this->twig = new Environment($loader, [
            'cache' => false,
        ]);

        $this->session = new Session();
        $this->session->start();
        $this->twig->addGlobal('session', $this->session);

        $dotenv = new Dotenv();
        $dotenv->load('../.env');
    }
}