<?php
//TWIG init
require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

// Connexion BDD

require_once("model/UserRepository.php");
require_once("model/PostRepository.php");
require_once("model/CategoryRepository.php");
require_once("model/CommentRepository.php");

$postRepo = new PostRepository;
$userRepo = new UserRepository;
$catRepo = new CategoryRepository;
$commentRepo = new CommentRepository;


echo $twig->render('website/home.html.twig');
