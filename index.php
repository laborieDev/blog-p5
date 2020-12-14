<?php
session_start();
//Twig init
require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/router/SessionObject.php';

//Router and Controllers init
require __DIR__ . '/router/AdminRouter.php';
require __DIR__ . '/router/AjaxRouter.php';
require __DIR__ . '/router/Router.php';

require __DIR__ . '/controller/PostController.php';
require __DIR__ . '/controller/CommentController.php';
require __DIR__ . '/controller/UserController.php';
require __DIR__ . '/controller/RequestController.php';

//Repositories Init
require __DIR__ . '/model/UserRepository.php';
require __DIR__ . '/model/PostRepository.php';
require __DIR__ . '/model/CategoryRepository.php';
require __DIR__ . '/model/CommentRepository.php';


$router = new Router;


$postRepo = new PostRepository;
$userRepo = new UserRepository;
$catRepo = new CategoryRepository;
$commentRepo = new CommentRepository;


$router->getRoute();


// echo $twig->render('website/home.html.twig');
