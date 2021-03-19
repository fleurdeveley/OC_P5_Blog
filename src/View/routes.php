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

return $routes;