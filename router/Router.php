<?php
class Router
{
    public $postController;
    public $commentController;
    public $userController;
    public $requestController;
    public $url;

    public function __construct()
    {
        $this->postController = new PostController;
        $this->commentController = new CommentController;
        $this->userController = new UserController;
        $this->requestController = new RequestController;

        $this->url = '';

        if (filter_input(INPUT_GET,'url')) {
            $this->url = explode('/', filter_input(INPUT_GET,'url'));
        }
    }

    /**
     * Get Route and Display good page 
     */
    public function getRoute()
    { 
        if ($this->url == '') {
            print($this->postController->getHomePage());
        }

        //ARTICLE SINGLE
        elseif ($this->url[0] == 'article' && !empty($this->url[1])) {
            print($this->postController->getArticleContent($this->url[1]));
        }

        //AJAX REQUEST
        elseif ($this->url[0] == 'ajax' && !empty($this->url[1])) {
            $this->ajaxRoutes();
        }

        //ADMIN CONNECTION - AJAX
        elseif ($this->url[0] == 'user-connect') {
            print($this->requestController->connectUser());
        }

        //ADMIN 
        elseif ($this->url[0] == 'admin') {
            $this->adminRoutes();
        }

        //ERROR 404
        else {
            print($this->requestController->get404Error());
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
                //CHANGEMENT STATUS COMMENTAIRE DASHBOARD AND COMMENTS LIST
                if ($this->url[1] == "set-comment" && !empty($this->url[2]) && !empty($this->url[3]) && !empty($this->url[4])) {
                    print($this->commentController->setCommentStatus($this->url[2], $this->url[3], $this->url[4]));
                }
                //ARTICLE
                else if ($this->url[1] == "article") {
                    if (!empty($this->url[2])) {
                        if ($this->url[2] == "new") {
                            print($this->postController->setPostPage());
                        } elseif ($this->url[2] == "add") {
                            print($this->postController->addNewPost());
                        } elseif ($this->url[2] == "edit" && !empty($this->url[3])) {
                            print($this->postController->setPostPage($this->url[3]));
                        } elseif ($this->url[2] == "editArticle" && !empty($this->url[3])) {
                            print($this->postController->editPost($this->url[3]));
                        } elseif ($this->url[2] == "delete" && !empty($this->url[3])) {
                            print($this->postController->deletePost($this->url[3]));
                        } elseif ($this->url[2] == "see-more" && !empty($this->url[3])) {
                            print($this->postController->seeMoreDashboardPosts($this->url[3]));
                        }
                        else{
                            print($this->requestController->get404Error());
                        }
                    } else {
                        print($this->postController->getDashboardPosts());
                    }
                }
                //USERS 
                else if ($this->url[1] == "user") {
                    if ($checkUser == "admin") {
                        if (!empty($this->url[2])) {
                            if($this->url[2] == "new"){
                                print($this->userController->setUserPage());
                            } elseif ($this->url[2] == "add") {
                                print($this->userController->addNewUser());
                            } elseif ($this->url[2] == "edit" && !empty($this->url[3])) {
                                print($this->userController->setUserPage($this->url[3]));
                            } elseif ($this->url[2] == "editUser" && !empty($this->url[3])) {
                                print($this->userController->editUser($this->url[3]));
                            } elseif ($this->url[2] == "delete" && !empty($this->url[3])) {
                                print($this->userController->deleteUser($this->url[3]));
                            } 
                        } else {
                            print($this->userController->getDashboardUsers());
                        }
                    } else {
                        print($this->userController->getUserTypeError());
                    }
                }
                //COMMENTAIRES
                else if ($this->url[1] == "comment") {
                    if (!empty($this->url[2])) {
                        if ($this->url[2] == "see-more" && !empty($this->url[3])) {
                            print($this->commentController->seeMoreDashboardComments($this->url[3]));
                        } elseif ($this->url[2] == "delete" && !empty($this->url[3])) {
                            print($this->commentController->deleteComment($this->url[3]));
                        } 
                    } else {
                        print($this->commentController->getAllComments());
                    }
                }
                //DECONNEXION
                else if ($this->url[1] == "disconnection") {
                    print($this->requestController->disconnectAdmin());
                }
                else {
                    print($this->requestController->getAdminDashboard());
                }
            } else {
                print($this->requestController->getAdminDashboard());
            }
        } else {
            print($this->requestController->getErrorAdminConnection());
        }
    }

    /**
     * Get all Ajax Routes
     */
    public function ajaxRoutes()
    {
        /**** BLOG POSTS HOME PAGE ****/
        if ($this->url[1] == 'more-post' && !empty($this->url[2])) {
            print($this->requestController->seeMorePost($this->url[2]));
        } elseif ($this->url[1] == 'more-comment' && !empty($this->url[2]) && !empty($this->url[3])) {
            print($this->requestController->seeMoreComment($this->url[2], $this->url[3]));
        } elseif ($this->url[1] == 'see-all-post') {
            print($this->requestController->seeMorePost());
        } elseif ($this->url[1] == 'see-cat-post' && !empty($this->url[2])) {
            if (!empty($this->url[3])) {
                print($this->requestController->seeCatPost($this->url[2], $this->url[3]));
            } else {
                print($this->requestController->seeCatPost($this->url[2]));
            }
        } elseif ($this->url[1] == 'send-contact-form') {
            print($this->requestController->sendContactForm());
        }
        /**** NEW COMMENT SINGLE POST ****/
        elseif ($this->url[1] == 'new-comment') {
            print($this->requestController->saveNewComment());
        }
    }
}
