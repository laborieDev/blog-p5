<?php

//TWIG init
require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

// Connexion BDD

include("entity/all_entity.php");

$user = new User(11);

echo $user->getLastName()." ";
if($user->isAdmin())
    echo "true";
else
    echo "false";

// $posts = $user->getPostsID();
// for($i=0; $i<sizeof($posts); $i++){
//     $post = new Post($posts[$i]);
//     $post = new Post(1);
//     echo $post->getTitle();
// }
echo $twig->render('layout.html.twig');