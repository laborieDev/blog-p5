<?php

//TWIG init
require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

// Connexion BDD

require_once("modele/UserRepository.php");
require_once("modele/PostRepository.php");
require_once("modele/CategoryRepository.php");
require_once("modele/CommentRepository.php");

$postRepo = new PostRepository;
$userRepo = new UserRepository;
$catRepo = new CategoryRepository;
$commentRepo = new CommentRepository;

echo $twig->render('website/home.html.twig');