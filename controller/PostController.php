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
            return $this->twig->render('website/errors_page.html.twig', [
                "error" => "Cet article n'existe pas !"
            ]);
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

    /**
     * Page for to create a post
     * @return twigRender New Post Form
     */
    public function addNewPostPage()
    {
        $cats = $this->catRepo->getCategories();

        return $this->twig->render('admin/new_post.html.twig', [
            'categories' => $cats
        ]);
    }

    /**
     * AJAX -- Add New Post
     * @return string Ajax response
     */
    public function addNewPost()
    {
        if (!isset($_POST['title'])) {
            return "Error";
        }

        $filename = $_FILES['file']['name'];
        $location = "assets/img/single_post/".$filename;

        if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
          
            $post = $this->postRepo->newPost($_SESSION['user-id']);
            $post->setTitle($_POST['title']);
            $post->setExtract($_POST['extract']);
            $post->setContent($_POST['content']);
            $post->setImg($filename);
            $this->postRepo->updatePost($post);

            $cats = explode("," , $_POST['allCats']);
            foreach ($cats as $cat) {
                $this->postRepo->addPostCategory($post, $cat);
            }

            return "Added";
            
        } else { 
          return "Error";
        }
    }
}
