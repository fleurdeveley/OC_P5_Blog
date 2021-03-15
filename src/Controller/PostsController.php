<?php

namespace Blog\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Blog\Model\PostManager;

class PostsController extends Controller {

    public function posts(Request $request) {
        $postManager = new PostManager();

        $posts = $postManager->getPosts();

        return new Response($this->twig->render('Frontend/posts.twig', ['posts' => $posts]));
    }

}