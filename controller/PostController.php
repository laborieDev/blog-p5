<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class PostController
{
    private $sessionObject;
    private $twig;
    private $postRepo;
    private $catRepo;
    private $commentRepo;
    private $userRepo;

    public function __construct()
    {
        $this->sessionObject = new SessionObject;
        $this->twig = new Environment(new FilesystemLoader('templates'));
        $this->twig->addGlobal('session', $this->sessionObject->getAll());
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

        if ($this->sessionObject->getVariable('user') !== false) {
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
    public function getArticleContent($postID)
    {
        $post = $this->postRepo->getPost($postID);
        
        if ($post == null) {
            return $this->twig->render('website/errors_page.html.twig', [
                "error" => "Cet article n'existe pas !"
            ]);
        }

        //Ajouter une vu à cette article
        $post->setViews($post->getViews() + 1);
        $this->postRepo->updatePost($post);
        
        $allCommentsID = $this->postRepo->getAllValidComments($post, 5);
        $allComments = [];
        foreach ($allCommentsID as $commentID) {
            array_push($allComments, $this->commentRepo->getComment($commentID));
        }
        $author = $this->userRepo->getUser($post->getAuthor());

        if ($this->sessionObject->getVariable('user') !== false) {
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
     * @return twigRender Dashboard of Posts
     */
    public function getDashboardPosts()
    {
        $posts = $this->postRepo->getPosts(10);

        return $this->twig->render('admin/all_posts.html.twig',[
            'posts' => $posts
        ]);
    }

    /**
     * Page for to create or edit a post
     * @param int idPostEdit = -1 when this function is called for create an article
     * @return twigRender New Post Form
     */
    public function setPostPage($idPostEdit = -1)
    {
        $cats = $this->catRepo->getCategories();

        if ($idPostEdit != -1) {
            $post = $this->postRepo->getPost($idPostEdit);
            $postCats = $this->postRepo->getAllCategories($post);
            $allCats = [];

            foreach ($postCats as $catID) {
                array_push($allCats, $this->catRepo->getCategory($catID));
            }

            if ($post == "") {
                return $this->twig->render('website/errors_page.html.twig', [
                    "error" => "Cet article n'existe pas !"
                ]);
            }

            return $this->twig->render('admin/set_post.html.twig', [
                'postEdit' => $post,
                'postCats' => $allCats,
                'categories' => $cats
            ]);
        }     

        return $this->twig->render('admin/set_post.html.twig', [
            'categories' => $cats
        ]);
    }

    /**
     * AJAX -- Add New Post
     * @return string Ajax response
     */
    public function addNewPost()
    {
        $title = filter_input(INPUT_POST, "title");
        $extract = filter_input(INPUT_POST, "extract");
        $content = filter_input(INPUT_POST, "content");

        if ((!isset($title)) || (!isset($extract)) || (!isset($content))) {
            return "Error";
        }

        $filename = $_FILES['file']['name'];
        $location = "assets/img/single_post/".$filename;

        if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
          
            $post = $this->postRepo->newPost($this->sessionObject->getVariable('userID'));
            $post->setTitle($title);
            $post->setExtract($extract);
            $post->setContent($content);
            $post->setImg($filename);
            $this->postRepo->updatePost($post);

            $cats = explode("," , filter_input(INPUT_POST,'allCats'));
            foreach ($cats as $cat) {
                $this->postRepo->addPostCategory($post, $cat);
            }

            return "Added";
            
        } else { 
          return "Error";
        }
    }

    /**
     * AJAX -- Edit Post
     * @param int postID
     * @return string Ajax response
     */
    public function editPost($postID)
    {
        $post = $this->postRepo->getPost($postID);

        $title = filter_input(INPUT_POST, "title");
        $extract = filter_input(INPUT_POST, "extract");
        $content = filter_input(INPUT_POST, "content");
        $allCats = filter_input(INPUT_POST, 'allCats');

        if ( (!isset($title)) || (!isset($extract)) || (!isset($content)) || (!isset($allCats)) || ($post == "") ) {
            return "Error";
        }

        $post->setTitle($title);
        $post->setExtract($extract);
        $post->setContent($content);

        if(isset($_FILES['file'])){
            $filename = $_FILES['file']['name'];
            $location = "assets/img/single_post/".$filename;

            if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
                $post->setImg($filename);
            }
        }

        $this->postRepo->updatePost($post);

        $this->postRepo->deleteCatsPostRelation($post);
        $cats = explode("," , $allCats);
        foreach ($cats as $cat) {
            $this->postRepo->addPostCategory($post, $cat);
        }

        return "Edited";
    }

    /**
     * AJAX -- Delete Post
     * @param int postID
     * @return JSON Ajax response
     */
    public function deletePost($postID)
    {
        $post = $this->postRepo->getPost($postID);

        if ($post == "") {
            return json_encode(array('message' => "L'article n'existe pas !"));
        }

        try{
            $this->postRepo->deletePost($post);
            $message = "L'article a bien été supprimé !";
        } catch (\Exception $e) {
            http_response_code(500);
            $message =  "Attention : " . $e->getMessage();
        }


        return json_encode(array('message' => $message));
    }

    /**
     * AJAX -- See More Posts on Dashboard
     * @param int nbPage
     * @return JSON Ajax response
     */
    public function seeMoreDashboardPosts($nbPage)
    {
        $postRepo = new PostRepository;

        $posts = $postRepo->getPosts(10, $nbPage);
        $allMinID = $postRepo->getPostMinID();

        $section = "";
        $minID;
        foreach ($posts as $post) {
            $postID = $post->id;
            $title = $post->title;
            $addAt = date_create($post->addAt);
            $addAt = date_format($addAt,"d.m.Y");
            $lastEditAt = date_create($post->lastEditAt);
            $lastEditAt = date_format($lastEditAt,"d.m.Y");
            $section .= "
                <tr id='row-post-$postID'>
                    <th scope='row'>$addAt</th>
                    <td class='title-cell'>$title</td>
                    <td class='last-edit-cell'>$lastEditAt</td>
                    <td class='buttons-cell'>
                      <a class='see' href='../article/$postID' target='_blank'><i class='lni lni-eye'></i></a>
                      <a class='see' href='../admin/article/edit/$postID' href='#'><i class='lni lni-pencil-alt'></i></a> ";
                      
            if ($this->sessionObject->getVariable('userType') == "admin") {
                $section .= "<a class='delete' onclick='getDeleteModal($postID)' href='#'><i class='lni lni-trash'></i></a>";
            }
            
            $section .= "</td>
                </tr>
            ";
            $minID = $postID;
        }
        $nbPage ++;

        if ($allMinID == $minID) {
            return json_encode(array('data' => $section, 'nbPage' => -1));
        } else { 
            return json_encode(array('data' => $section, 'nbPage' => $nbPage));
        }
    }
}
