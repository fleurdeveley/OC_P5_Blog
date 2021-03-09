<?php

require __DIR__ . '/../vendor/autoload.php';

use Blog\Controller\HomeController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$homeController = new HomeController();
$content = $homeController->home();

$response = new Response();
$response->headers->set('Content-type', 'text/html; charset=utf-8');
$response->setContent($content);

$response->send();