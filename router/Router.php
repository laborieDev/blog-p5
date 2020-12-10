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
            print_r($this->postController->getHomePage());
        }

        //ARTICLE SINGLE
        elseif ($this->url[0] == 'article' && !empty($this->url[1])) {
            print_r($this->postController->getArticleContent($this->url[1]));
        }

        //AJAX REQUEST
        elseif ($this->url[0] == 'ajax' && !empty($this->url[1])) {
            $this->ajaxRoutes();
        }

        //ADMIN CONNECTION - AJAX
        elseif ($this->url[0] == 'user-connect') {
            print_r($this->requestController->connectUser());
        }

        //ADMIN 
        elseif ($this->url[0] == 'admin') {
            $this->adminRoutes();
        }

        //ERROR 404
        else {
            print_r($this->requestController->get404Error());
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
                    print_r($this->commentController->setCommentStatus($this->url[2], $this->url[3], $this->url[4]));
                }
                //ARTICLE
                else if ($this->url[1] == "article") {
                    if (!empty($this->url[2])) {
                        if ($this->url[2] == "new") {
                            print_r($this->postController->setPostPage());
                        } elseif ($this->url[2] == "add") {
                            print_r($this->postController->addNewPost());
                        } elseif ($this->url[2] == "edit" && !empty($this->url[3])) {
                            print_r($this->postController->setPostPage($this->url[3]));
                        } elseif ($this->url[2] == "editArticle" && !empty($this->url[3])) {
                            print_r($this->postController->editPost($this->url[3]));
                        } elseif ($this->url[2] == "delete" && !empty($this->url[3])) {
                            print_r($this->postController->deletePost($this->url[3]));
                        } elseif ($this->url[2] == "see-more" && !empty($this->url[3])) {
                            print_r($this->postController->seeMoreDashboardPosts($this->url[3]));
                        }
                        else{
                            print_r($this->requestController->get404Error());
                        }
                    } else {
                        print_r($this->postController->getDashboardPosts());
                    }
                }
                //USERS 
                else if ($this->url[1] == "user") {
                    if ($checkUser == "admin") {
                        if (!empty($this->url[2])) {
                            if($this->url[2] == "new"){
                                print_r($this->userController->setUserPage());
                            } elseif ($this->url[2] == "add") {
                                print_r($this->userController->addNewUser());
                            } elseif ($this->url[2] == "edit" && !empty($this->url[3])) {
                                print_r($this->userController->setUserPage($this->url[3]));
                            } elseif ($this->url[2] == "editUser" && !empty($this->url[3])) {
                                print_r($this->userController->editUser($this->url[3]));
                            } elseif ($this->url[2] == "delete" && !empty($this->url[3])) {
                                print_r($this->userController->deleteUser($this->url[3]));
                            } 
                        } else {
                            print_r($this->userController->getDashboardUsers());
                        }
                    } else {
                        print_r($this->userController->getUserTypeError());
                    }
                }
                //COMMENTAIRES
                else if ($this->url[1] == "comment") {
                    if (!empty($this->url[2])) {
                        if ($this->url[2] == "see-more" && !empty($this->url[3])) {
                            print_r($this->commentController->seeMoreDashboardComments($this->url[3]));
                        } elseif ($this->url[2] == "delete" && !empty($this->url[3])) {
                            print_r($this->commentController->deleteComment($this->url[3]));
                        } 
                    } else {
                        print_r($this->commentController->getAllComments());
                    }
                }
                //DECONNEXION
                else if ($this->url[1] == "disconnection") {
                    print_r($this->requestController->disconnectAdmin());
                }
                else {
                    print_r($this->requestController->getAdminDashboard());
                }
            } else {
                print_r($this->requestController->getAdminDashboard());
            }
        } else {
            print_r($this->requestController->getErrorAdminConnection());
        }
    }

    /**
     * Get all Ajax Routes
     */
    public function ajaxRoutes()
    {
        /**** BLOG POSTS HOME PAGE ****/
        if ($this->url[1] == 'more-post' && !empty($this->url[2])) {
            print_r($this->requestController->seeMorePost($this->url[2]));
        } elseif ($this->url[1] == 'more-comment' && !empty($this->url[2]) && !empty($this->url[3])) {
            print_r($this->requestController->seeMoreComment($this->url[2], $this->url[3]));
        } elseif ($this->url[1] == 'see-all-post') {
            print_r($this->requestController->seeMorePost());
        } elseif ($this->url[1] == 'see-cat-post' && !empty($this->url[2])) {
            if (!empty($this->url[3])) {
                print_r($this->requestController->seeCatPost($this->url[2], $this->url[3]));
            } else {
                print_r($this->requestController->seeCatPost($this->url[2]));
            }
        } elseif ($this->url[1] == 'send-contact-form') {
            print_r($this->requestController->sendContactForm());
        }
        /**** NEW COMMENT SINGLE POST ****/
        elseif ($this->url[1] == 'new-comment') {
            print_r($this->requestController->saveNewComment());
        }
    }
}
