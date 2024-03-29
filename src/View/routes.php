<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    '_controller' => '\Blog\Controller\HomeController::home'
]));

$routes->add('posts', new Route('/articles', [
    '_controller' => '\Blog\Controller\PostsController::posts'
]));

$routes->add('post', new Route('/articles/{id}', [
    '_controller' => '\Blog\Controller\PostsController::post'
]));

$routes->add('login', new Route('/login', [
    '_controller' => '\Blog\Controller\LoginController::login'
]));

$routes->add('register', new Route('/register', [
    '_controller' => '\Blog\Controller\LoginController::register'
]));

$routes->add('logout', new Route('/logout', [
    '_controller' => '\Blog\Controller\LoginController::logout'
]));

$routes->add('administrator', new Route('/administrateur', [
    '_controller' => '\Blog\Controller\AdministratorController::administrator'
]));

$routes->add('adminPost', new Route('/adminpost', [
    '_controller' => '\Blog\Controller\PostsController::adminPost'
]));

$routes->add('readPost', new Route('/readpost/{postId}', [
    '_controller' => '\Blog\Controller\PostsController::readPost'
]));

$routes->add('editPost', new Route('/editpost/{postId}', [
    '_controller' => '\Blog\Controller\PostsController::editPost'
]));

$routes->add('addPost', new Route('/addpost', [
    '_controller' => '\Blog\Controller\PostsController::addPost'
]));

$routes->add('deletePost', new Route('/deletepost/{postId}', [
    '_controller' => '\Blog\Controller\PostsController::deletePost'
]));

$routes->add('adminComment', new Route('/admincomment', [
    '_controller' => '\Blog\Controller\CommentsController::adminComment'
]));

$routes->add('validateComment', new Route('/validatecomment/{commentId}', [
    '_controller' => '\Blog\Controller\CommentsController::validateComment'
]));

$routes->add('refuseComment', new Route('/refusecomment/{commentId}', [
    '_controller' => '\Blog\Controller\CommentsController::refuseComment'
]));

return $routes;