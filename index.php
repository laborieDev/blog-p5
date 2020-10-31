<?php

//TWIG init
require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

// Connexion BDD

require_once("entity/all_entity.php");

$user = new User(1);

$user->setLastName('LABORIE');
$user->setFirstName('Anthony');

echo $user->getLastName()." ".$user->getFirstName();


echo $twig->render('layout.html.twig');