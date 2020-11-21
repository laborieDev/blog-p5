<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RequestController
{
    private $twig;

    public function __construct()
    {
        $this->twig = new Environment(new FilesystemLoader('templates'));
    }

    /********* ADMIN CONNECTION *********/

    /**
     * @return string return userType if user is connected else return false
     */
    public function checkUser()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user-type'];
        } else {
            return "false";
        }
    }

    /**
     * Connect user and redirect to dashboard
     */
    public function connectUser()
    {
        $userRepo = new UserRepository;
        $user = $userRepo->getUserParameter('email', $_POST['email']);

        if ($user == "" || $user->getPassword() != $_POST['password']) {
            return "Error";
        }
        
        $_SESSION['user'] = $user->getLastName()." ".$user->getFirstName();
        $_SESSION['user-type'] = $user->getUserType();
        $_SESSION['user-id'] = $user->getID();
            
        return "Connected";
    }

    /**
     * Disconnect user and redirect to home page
     */
    public function disconnectAdmin()
    {
        session_destroy();
        echo "<script> document.location.href='/blog-p5'; </script>"; 
    }

    /**
     * @return twigRender Error Page --> User isn't connected
     */
    public function getErrorAdminConnection()
    {
        return $this->twig->render('website/errors_page.html.twig', [
            "error" => "Une connexion est requise pour accéder à ce site !"
        ]);
    }

    /**
     * @return twigRender Dashboard Admin
     */
    public function getAdminDashboard()
    {
        $commentRepo = new CommentRepository;
        $numberComment = $commentRepo->getNumberComment();
        $comments = $commentRepo->getWaitingComments();

        $postRepo = new PostRepository;
        $numberViews = $postRepo->getAllViews();

        return $this->twig->render('admin/dashboard.html.twig',[
            'numberComments' => $numberComment,
            'numberViews' => $numberViews,
            'comments' => $comments
        ]);
    }

    /********* ADMIN PAGES *********/


    /********* AJAX REQUEST *********/

    /**
     * @param int maxID minimum ID of actual posts
     * @return json A Json Array with posts datas and minID of this posts
     */
    public function seeMorePost($maxID = 0)
    {
        $postRepo = new PostRepository;

        $posts = $postRepo->getPosts(4, $maxID);

        $section = "";
        $i = 1;
        $minID;
        foreach ($posts as $post) {
            $id = $post->id;
            $title = $post->title;
            $img = $post->img;
            $extract = $post->extract;
            $section .= "
                        <div class='single single-{$i} col-lg-6' style='background-image:url(\"assets/img/single_post/{$img}\")'>
							<div class='infos'>
								<div>
									<h2>{$title}</h2>
									<p class='extract'>{$extract}</p>
									<a href='article/{$id}' class='btn view-more'>En voir plus</a>
								</div>
							</div>
                        </div>
            ";
            $i++;
            $minID = $id;
        }
        
        if ($i < 4) {
            return json_encode(array('data' => $section, 'minID' => -1));
        } else { 
            return json_encode(array('data' => $section, 'minID' => $minID));
        }
    }

    /**
     * @param int catID ID of category
     * @param int maxID minimum ID of actual posts
     * @return json A Json Array with posts datas and minID of this posts
     */
    public function seeCatPost($catID, $maxID = 0)
    {
        $postRepo = new PostRepository;
        $posts = $postRepo->getCatPosts($catID, 4, $maxID);

        $section = "";
        $i = 1;
        $minID;
        foreach ($posts as $post) {
            $id = $post->id;
            $title = $post->title;
            $img = $post->img;
            $extract = $post->extract;
            $section .= "
                        <div class='single single-{$i} col-lg-6' style='background-image:url(\"assets/img/single_post/{$img}\")'>
							<div class='infos'>
								<div>
									<h2>{$title}</h2>
									<p class='extract'>{$extract}</p>
									<a href='article/{$id}' class='btn view-more'>En voir plus</a>
								</div>
							</div>
                        </div>
            ";
            $i++;
            $minID = $id;
        }
        
        if ($i < 4) {
            return json_encode(array('data' => $section, 'minID' => -1));
        } else { 
            return json_encode(array('data' => $section, 'minID' => $minID));
        }
    }

    /**
     * @param int postID ID of comment's post
     * @param string authorName Name of comment's author
     * @param string content Comment's content
     * @return int status Status of request 
     */
    public function saveNewComment($postID, $authorName, $content)
    {
        $commentRepo = new CommentRepository;
        $comment = $commentRepo->newComment($postID);
        $comment->setAuthorName($authorName);
        $comment->setContent($content);
        $commentRepo->updateComment($comment);

        return 200;
    }

    /*** BAD REQUEST ***/

    /**
     * @return twigRender template of 404 Page
     */
    public function get404Error()
    {
        return $this->twig->render('website/errors_page.html.twig', [
            "error" => "Cette page n'existe pas !"
        ]);
    }
}
