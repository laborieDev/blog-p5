<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class PostController
{
    private $loader;
    private $twig;
    private $postRepo;
    private $catRepo;

    public function __construct()
    {
        $this->loader = new FilesystemLoader('templates');
        $this->twig = new Environment($this->loader);
        $this->postRepo = new PostRepository;
        $this->catRepo = new CategoryRepository;
    }

    public function getHomePage()
    {
        $posts = $this->postRepo->getPosts(4);
        $cats = $this->catRepo->getCategories();
        return $this->twig->render('website/home.html.twig',[
            'posts' => $posts,
            'cats' => $cats
        ]);
    }

}