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
        $allCommentsID = $this->postRepo->getAllValidComments($post);
        $allComments = [];
        foreach ($allCommentsID as $commentID) {
            array_push($allComments, $this->commentRepo->getComment($commentID));
        }
        $author = $this->userRepo->getUser($post->getAuthor());

        return $this->twig->render('website/single_post.html.twig',[
            'post' => $post,
            'comments' => $allComments,
            'author' => $author
        ]);
    }

}