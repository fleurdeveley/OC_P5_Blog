<?php

namespace Blog\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Blog\Model\PostsManager;

class PostsController extends Controller {

    public function posts(Request $request) {
        $postsManager = new PostsManager();

        $posts = $postsManager->getPosts();

        return new Response($this->twig->render('Frontend/posts.twig', ['posts' => $posts]));
    }

}