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
        $this->commentRepo = new CommentRepository;
        $this->userRepo = new UserRepository;
    }

    /**
     * @return twigRender HomePage with all blog's categories and last posts
     */
    public function getHomePage()
    {
        $posts = $this->postRepo->getPosts(4);
        $cats = $this->catRepo->getCategories();

        if (isset($_SESSION['user'])) {
            return $this->twig->render('website/home.html.twig',[
                'posts' => $posts,
                'cats' => $cats,
                'userConnected' => true
            ]);
        }

        return $this->twig->render('website/home.html.twig',[
            'posts' => $posts,
            'cats' => $cats
        ]);
    }

    /**
     * @param int id Post's id
     * @return twigRender Single Post with all post's comments and author datas
     */
    public function getArticleContent($id)
    {
        $post = $this->postRepo->getPost($id);
        
        if ($post == null) {
            return $this->twig->render('website/error_404.html.twig');
        }

        //Ajouter une vu à cette article
        $post->setViews($post->getViews() + 1);
        $this->postRepo->updatePost($post);
        
        $allCommentsID = $this->postRepo->getAllValidComments($post);
        $allComments = [];
        foreach ($allCommentsID as $commentID) {
            array_push($allComments, $this->commentRepo->getComment($commentID));
        }
        $author = $this->userRepo->getUser($post->getAuthor());

        if (isset($_SESSION['user'])) {
            return $this->twig->render('website/single_post.html.twig',[
                'post' => $post,
                'comments' => $allComments,
                'author' => $author,
                'userConnected' => true
            ]);
        }

        return $this->twig->render('website/single_post.html.twig',[
            'post' => $post,
            'comments' => $allComments,
            'author' => $author
        ]);
    }
}
