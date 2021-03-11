<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    '_controller' => [new \Blog\Controller\HomeController(), 'home']
]));

$routes->add('posts', new Route('/articles', [
    '_controller' => [new \Blog\Controller\PostsController(), 'posts']
]));

return $routes;