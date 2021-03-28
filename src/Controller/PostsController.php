<?php

namespace Blog\Controller;

use Blog\Form\Field\TextareaField;
use Blog\Form\Field\TextField;
use Blog\Form\Form;
use Blog\Model\CategoryManager;
use Blog\Model\Comment;
use Blog\Model\CommentsManager;
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

        $commentManager = new CommentsManager();
        $comments = $commentManager->all($post->getId());

        $userManager = new UserManager();
        $user = $userManager->one($post->getUserId());


        if ($request->getMethod() == 'POST')
        {
            $comment = new Comment([
                'post_id' => $id,
                'author' => $request->request->get('author'),
                'content' => $request->request->get('content')
            ]);
        }
        else
        {
            $comment = new Comment;
        }

        $form = new Form($comment);

        $form->add(new TextField([
            'label' => 'Auteur',
            'name' => 'author',
            'maxLength' => 30
        ]))
            ->add(new TextareaField([
                'label' => 'Commentaire',
                'name' => 'content'
            ]));

        if ($request->getMethod() == 'POST'&& $form->isValid())
        {
            $affectedLines = $commentManager->postComment($comment);
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
}