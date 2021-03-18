<?php

namespace Blog\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Blog\Model\PostsManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class PostsController
 * return posts view
 */

class PostsController extends Controller {

    /**
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function posts(Request $request): Response
    {
        $postsManager = new PostsManager();

        $posts = $postsManager->getPosts();

        return new Response($this->twig->render('Frontend/posts.twig', ['posts' => $posts]));
    }

}