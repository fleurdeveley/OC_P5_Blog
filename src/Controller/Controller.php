<?php

namespace Blog\Controller;

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
     * Controller constructor.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader('../src/View');
        $this->twig = new Environment($loader, [
            'cache' => false,
        ]);
    }
}