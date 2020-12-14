<?php
class AjaxRouter
{
    public $postController;
    public $commentController;
    public $userController;
    public $requestController;

    public function __construct()
    {
        $this->postController = new PostController;
        $this->commentController = new CommentController;
        $this->userController = new UserController;
        $this->requestController = new RequestController;
    }

    /**
     * Get Route and Display good page 
     */
    public function getRoute($url)
    { 
        /**** BLOG POSTS HOME PAGE ****/
        if ($url[1] == 'more-post' && !empty($url[2])) {
            return $this->requestController->seeMorePost($url[2]);
        } elseif ($url[1] == 'more-comment' && !empty($url[2]) && !empty($url[3])) {
            return $this->requestController->seeMoreComment($url[2], $url[3]);
        } elseif ($url[1] == 'see-all-post') {
            return $this->requestController->seeMorePost();
        } elseif ($url[1] == 'see-cat-post' && !empty($url[2])) {
            if (!empty($url[3])) {
                return $this->requestController->seeCatPost($url[2], $url[3]);
            } else {
                return $this->requestController->seeCatPost($url[2]);
            }
        } elseif ($url[1] == 'send-contact-form') {
            return $this->requestController->sendContactForm();
        }
        /**** NEW COMMENT SINGLE POST ****/
        elseif ($url[1] == 'new-comment') {
            return $this->requestController->saveNewComment();
        }
    }   
}
