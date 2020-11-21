<?php
class Router
{
    public $postController;
    public $commentController;
    public $requestController;
    public $url;

    public function __construct()
    {
        $this->postController = new PostController;
        $this->commentController = new CommentController;
        $this->requestController = new RequestController;

        $this->url = '';

        if (isset($_GET['url'])) {
            $this->url = explode('/', $_GET['url']);
        }
    }

    /**
     * Get Route and Display good page 
     */
    public function getRoute()
    { 

        if ($this->url == '') {
            echo $this->postController->getHomePage();
        }

        //ARTICLE SINGLE
        elseif ($this->url[0] == 'article' && !empty($this->url[1])) {
            echo $this->postController->getArticleContent($this->url[1]);
        }

        //AJAX REQUEST
        elseif ($this->url[0] == 'ajax' && !empty($this->url[1])) {
            $this->ajaxRoutes();
        }

        //ADMIN CONNECTION - AJAX
        elseif ($this->url[0] == 'user-connect'){
            echo $this->requestController->connectUser();
        }

        //ADMIN 
        elseif ($this->url[0] == 'admin') {
            $this->adminRoutes();
        }

        //ERROR 404
        else {
            echo $this->requestController->get404Error();
        }
    }   

    /**
     * Get all Admin Routes
     */
    public function adminRoutes()
    {
        $checkUser = $this->requestController->checkUser();
        if ($checkUser != "false") {
            if (isset($this->url[1])) {
                //CHANGEMENT STATUS COMMENTAIRE
                if ($this->url[1] == "set-comment" && !empty($this->url[2]) && !empty($this->url[3])) {
                    echo $this->commentController->setCommentStatus($this->url[2], $this->url[3]);
                }
                //ARTICLE
                else if ($this->url[1] == "article" && !empty($this->url[2])) {
                    if ($this->url[2] == "new") {
                        echo $this->postController->addNewPostPage();
                    } elseif ($this->url[2] == "add") {
                        echo $this->postController->addNewPost();
                    }
                }
                //DECONNEXION
                else if ($this->url[1] == "disconnection") {
                    echo $this->requestController->disconnectAdmin();
                }
                else {
                    echo $this->requestController->getAdminDashboard();
                }
            } else {
                echo $this->requestController->getAdminDashboard();
            }
        } else {
            echo $this->requestController->getErrorAdminConnection();
        }
    }

    /**
     * Get all Ajax Routes
     */
    public function ajaxRoutes()
    {
        /**** BLOG POSTS HOME PAGE ****/
        if ($this->url[1] == 'more-post' && !empty($this->url[2])) {
            echo $this->requestController->seeMorePost($this->url[2]);
        } elseif ($this->url[1] == 'see-all-post') {
            echo $this->requestController->seeMorePost();
        } elseif ($this->url[1] == 'see-cat-post' && !empty($this->url[2])) {
            if (!empty($this->url[3])) {
                echo $this->requestController->seeCatPost($this->url[2], $this->url[3]);
            } else {
                echo $this->requestController->seeCatPost($this->url[2]);
            }
        }
        /**** NEW COMMENT SINGLE POST ****/
        elseif ($this->url[1] == 'new-comment' && !empty($this->url[2]) && !empty($this->url[3]) && !empty($this->url[4])) {
            echo $this->requestController->saveNewComment($this->url[2], $this->url[3], $this->url[4]);
        }
    }
}
