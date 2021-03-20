<?php

namespace Blog\Controller;

use \Blog\Model\PostsManager;
use Blog\Model\UserManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class PostsController
 */

class PostsController extends Controller
{
    /**
     * @var PostsManager
     */
    private $postsManager;
    private $userManager;

    /**
     * PostsController constructor.
     */
    public function __construct()
    {
        $this->postsManager = new PostsManager();
        $this->userManager = new UserManager();

        parent::__construct();
    }

    /**
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function posts(Request $request): Response
    {
        $posts = $this->postsManager->all();

        return new Response($this->twig->render('Frontend/posts.twig', ['posts' => $posts]));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function post(Request $request, $id): Response
    {
        $post = $this->postsManager->one($id);
        $user = $this->userManager->one($id);

        return new Response($this->twig->render('Frontend/post.twig', ['post' => $post, 'user' => $user]));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function user(Request $request, $id): Response
    {



    }
}