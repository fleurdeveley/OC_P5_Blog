<?php

namespace Blog\Controller;

use Blog\Form\FormBuilder\AddPostFormBuilder;
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
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function posts(): Response
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
            $this->session->getFlashBag()->add('add-comment', 'Le commentaire a été envoyé avec succes !
            ');
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
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function adminPost(): Response
    {
        $postsManager = new PostsManager();
        $posts = $postsManager->all();

        return new Response($this->twig->render('Backend/Post/adminPost.twig', ['posts' => $posts]));
    }

    /**
     * @param $postId
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function readPost($postId): Response
    {
        $postsManager = new PostsManager();
        $post = $postsManager->one($postId);

        $categoryManager = new CategoryManager();
        $category = $categoryManager->one($post->getCategoryId());

        $userManager = new UserManager();
        $user = $userManager->one($post->getUserId());

        return new Response($this->twig->render('Backend/Post/readPost.twig',
            [
                'post' => $post,
                'category' => $category,
                'user' => $user
            ]
        ));
    }

    /**
     * @param Request $request
     * @param $postId
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function editPost(Request $request, $postId): Response
    {
        $postsManager = new PostsManager();
        $post = $postsManager->one($postId);

        $categoriesManager = new CategoryManager();

        if($request->getMethod() == 'POST') {

            $post = new Post([
                'id' => $postId,
                'title' => $request->request->get('title'),
                'category_id' => $request->request->get('category_id'),
                'chapo' => $request->request->get('chapo'),
                'content' => $request->request->get('content'),
                'picture' => $post->getPicture()
            ]);

            if ($request->files->get('picture')) {
                $file = $request->files->get('picture');
                $file->move('../public/img/', $file->getClientOriginalName());
                $post->setPicture('/img/' . $file->getClientOriginalName());
            }

        } else {
            $post = $postsManager->one($postId);
        }

        $categories = $categoriesManager->all();

        $options = [];
        foreach($categories as $category) {
            $options[$category->getId()] = $category->getName();
        }

        $formBuilder = new EditPostFormBuilder($post, $options);
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

    /**
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function addPost(Request $request): Response
    {
        $postsManager = new PostsManager();
        $categoriesManager = new CategoryManager();

        if($request->getMethod() == 'POST') {

            $file = $request->files->get('picture');
            $file->move('../public/img/', $file->getClientOriginalName());

            $post = new Post([
                'title' => $request->request->get('title'),
                'category_id' => $request->request->get('category_id'),
                'user_id' => $this->session->get('user_id'),
                'chapo' => $request->request->get('chapo'),
                'content' => $request->request->get('content'),
                'picture' => '/img/' . $file->getClientOriginalName()
            ]);
        } else {
            $post = new Post(['user_id' => $this->session->get('user_id')]);
        }

        $categories = $categoriesManager->all();

        $options = [];
        foreach($categories as $category) {
            $options[$category->getId()] = $category->getName();
        }

        $formBuilder = new AddPostFormBuilder($post, $options);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $postsManager, $request);

        if($formHandler->process()) {
            return new RedirectResponse('/adminpost');
        }

        return new Response($this->twig->render('Backend/Post/addPost.twig',
            [
                'post' => $post,
                'form' => $form->createView()
            ]));
    }

    /**
     * @param $postId
     * @return Response
     * @throws \Exception
     */
    public function deletePost($postId): Response
    {
        $postsManager = new PostsManager();
        $post = $postsManager->delete($postId);

        return new RedirectResponse('/adminpost');
    }
}