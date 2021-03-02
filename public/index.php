<?php

use Twig\Loader\FilesystemLoader;

require __DIR__ . '/../vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__ . '/../src/View');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

echo $twig->render('layout.twig.php');