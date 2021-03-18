<?php

namespace Blog\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Loader\FilesystemLoader;

class PostsController {

    public function posts(Request $request) {
        return new Response('articles');
    }

}