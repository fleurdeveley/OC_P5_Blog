<?php

namespace Blog\Controller;

use Blog\Model\CategoryManager;
use Blog\Model\PostsManager;
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
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function posts(Request $request): Response
    {
        $postsManager = new PostsManager();
        $posts = $postsManager->all();

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
        $postsManager = new PostsManager();
        $post = $postsManager->one($id);

        $categoryManager = new CategoryManager();
        $category = $categoryManager->one($post->getCategoryId());

        $userManager = new UserManager();
        $user = $userManager->one($post->getUserId());

        return new Response($this->twig->render('Frontend/post.twig',
            [
                'post' => $post,
                'user' => $user,
                'category' => $category
            ]
        ));
    }
}