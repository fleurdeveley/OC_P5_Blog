<?php

namespace Blog\Controller;

use Blog\Model\Comment;
use Blog\Model\CommentsManager;
use Blog\Model\Manager;
use Blog\Model\Model;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class CommentsController
 * return comment view
 */

class CommentsController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function adminComment(Request $request): Response
    {
        $commentManager = new CommentsManager();
        $comments = $commentManager->getCommentsAwaitingValidation();

        return new Response($this->twig->render('Backend/Comment/adminComment.twig', ['comments' => $comments]));
    }


    /**
     * @param Request $request
     * @param $id
     * @return Response
     * @throws \Exception
     */
    public function refuseComment(Request $request, $id): Response
    {
        $commentManager = new CommentsManager();
        $comments = $commentManager->refuseComment($id);

        return new RedirectResponse('/admincomment');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function validateComment(Request $request, $id): Response
    {
        $commentManager = new CommentsManager();
        $comments = $commentManager->validateComment($id);

        return new RedirectResponse('/admincomment');
    }
}