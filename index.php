<?php

//TWIG init
require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

// Connexion BDD
    require_once("modele/mdl_data_base.php");
    $pdo = mdl_data_base::getclass_pdo();
