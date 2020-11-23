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
     * Save New Comment - Ajax Request
     * @return Response 
     */
    public function saveNewComment()
    {
        try {
            $commentRepo = new CommentRepository;
            $comment = $commentRepo->newComment($_POST['postID']);
            $comment->setAuthorName($_POST['authorName']);
            $comment->setContent($_POST['message']);
            $commentRepo->updateComment($comment);
            http_response_code(200);
        }
        catch (\Exception $e) {
            http_response_code(500);
            echo "Attention : " . $e->getMessage();
        }
    }

     /**
     * @param int maxID minimum ID of actual comments
     * @return json A Json Array with posts datas and minID of this posts
     */
    public function seeMoreComment($postID, $maxID = 0)
    {
        $postRepo = new PostRepository;
        $commentRepo = new CommentRepository;

        $post = $postRepo->getPost($postID);
        $allCommentsID = $postRepo->getAllValidComments($post, 5, $maxID);

        $section = "";
        $i = 1;
        $minID;
        foreach ($allCommentsID as $commentID) {
            $comment = $commentRepo->getComment($commentID);
            $id = $comment->getID();
            $date = date_create($comment->getAddAt());
            $date = date_format($date, 'd.m.Y');
            $authorName = $comment->getAuthorName();
            $content = $comment->getContent();
            $section .= "
                <div class='comment-single row'>
                    <div class='col-md-9 author-name'>
                        <p>$authorName</p>
                    </div>
                    <div class='col-md-3 date'>
                        <p>$date</p>
                    </div>
                    <div class='col-md-12 content'>
                    <p>$content</p>
                    </div>
                </div>
            ";
            $i++;
            $minID = $id;
        }
        
        if ($i < 5) {
            return json_encode(array('data' => $section, 'minID' => -1));
        } else { 
            return json_encode(array('data' => $section, 'minID' => $minID));
        }
    }

    /*** BAD REQUEST ***/

    /**
     * @return twigRender template of 404 Page
     */
    public function get404Error()
    {
        return $this->twig->render('website/error_404.html.twig');
    }
}
