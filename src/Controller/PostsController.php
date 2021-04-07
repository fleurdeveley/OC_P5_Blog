<?php

namespace Blog\Controller;

use Blog\Form\FormBuilder\CommentFormBuilder;
use Blog\Form\FormBuilder\EditPostFormBuilder;
use Blog\Form\FormHandler;
use Blog\Model\CategoryManager;
use Blog\Model\Comment;
use Blog\Model\CommentsManager;
use Blog\Model\Post;
use Blog\Model\PostsManager;
use Blog\Model\UserManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class PostsController
 * return post view
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

        $commentManager = new CommentsManager();
        $comments = $commentManager->all($post->getId());

        $userManager = new UserManager();
        $user = $userManager->one($post->getUserId());


        if($request->getMethod() == 'POST') {
            $comment = new Comment([
                'post_id' => $id,
                'author' => $request->request->get('author'),
                'content' => $request->request->get('content')
            ]);
        } else {
            $comment = new Comment;
        }

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $commentManager, $request);

        if($formHandler->process()) {
            $this->session->getFlashBag()->add('add-comment', 'Le commentaire a été envoyé avec succes !');
        }

        return new Response($this->twig->render('Frontend/post.twig',
            [
                'post' => $post,
                'category' => $category,
                'comments' => $comments,
                'user' => $user,
                'form' => $form->createView()
            ]
        ));
    }

    /**
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function adminPost(Request $request): Response
    {
        $postsManager = new PostsManager();
        $posts = $postsManager->all();

        return new Response($this->twig->render('Backend/Post/adminPost.twig', ['posts' => $posts]));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function editPost(Request $request, $id): Response
    {
        $postsManager = new PostsManager();
        $post = $postsManager->one($id);

        if($request->getMethod() == 'POST') {
            $post = new Post([
                'id' => $id,
                'title' => $request->request->get('title'),
                'chapo' => $request->request->get('chapo'),
                'content' => $request->request->get('content'),
                'picture' => $request->request->get('picture')
            ]);
        } else {
            $post = $postsManager->one($id);
        }

        $formBuilder = new EditPostFormBuilder($post);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $postsManager, $request);

        if($formHandler->process()) {
            return new RedirectResponse('/adminpost');
        }

        return new Response($this->twig->render('Backend/Post/editPost.twig',
            [
                'post' => $post,
                'form' => $form->createView()
            ]));
    }
}