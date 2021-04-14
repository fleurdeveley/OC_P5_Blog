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

$routes->add('readPost', new Route('/readpost/{id}', [
    '_controller' => '\Blog\Controller\PostsController::readPost'
]));

$routes->add('editPost', new Route('/editpost/{id}', [
    '_controller' => '\Blog\Controller\PostsController::editPost'
]));

$routes->add('addPost', new Route('/addpost', [
    '_controller' => '\Blog\Controller\PostsController::addPost'
]));

$routes->add('deletePost', new Route('/deletepost/{id}', [
    '_controller' => '\Blog\Controller\PostsController::deletePost'
]));

return $routes;