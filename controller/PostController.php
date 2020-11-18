<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class PostController
{
    private $twig;
    private $postRepo;
    private $catRepo;

    public function __construct()
    {
        $this->twig = new Environment(new FilesystemLoader('templates'));
        $this->postRepo = new PostRepository;
        $this->catRepo = new CategoryRepository;
    }

    /**
     * @return twigRender HomePage with all blog's categories and last posts
     */
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
