<?php

namespace Blog\Controller;

use Blog\Model\CommentsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function adminComment(): Response
    {
        $commentManager = new CommentsManager();
        $comments = $commentManager->getCommentsAwaitingValidation();

        return new Response($this->twig->render('Backend/Comment/adminComment.twig', ['comments' => $comments]));
    }


    /**
     * @param $commentId
     * @return Response
     * @throws \Exception
     */
    public function refuseComment($commentId): Response
    {
        $commentManager = new CommentsManager();
        $comments = $commentManager->refuseComment($commentId);

        return new RedirectResponse('/admincomment');
    }

    /**
     * @param $commentId
     * @return Response
     */
    public function validateComment($commentId): Response
    {
        $commentManager = new CommentsManager();
        $comments = $commentManager->validateComment($commentId);

        return new RedirectResponse('/admincomment');
    }
}