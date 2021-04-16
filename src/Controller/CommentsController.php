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
     * @param $id
     * @return Response
     * @throws \Exception
     */
    public function refuseComment($id): Response
    {
        $commentManager = new CommentsManager();
        $comments = $commentManager->refuseComment($id);

        return new RedirectResponse('/admincomment');
    }

    /**
     * @param $id
     * @return Response
     */
    public function validateComment($id): Response
    {
        $commentManager = new CommentsManager();
        $comments = $commentManager->validateComment($id);

        return new RedirectResponse('/admincomment');
    }
}