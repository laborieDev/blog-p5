<?php
class AdminRouter
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
     * Get Route and Display good page - ADMIN ROUTER
     */
    public function getRoute($url)
    { 
        $checkUser = $this->requestController->checkUser();
        if ($checkUser != "false") {
            if (isset($url[1])) {
                //CHANGEMENT STATUS COMMENTAIRE DASHBOARD AND COMMENTS LIST
                if ($url[1] == "set-comment" && !empty($url[2]) && !empty($url[3]) && !empty($url[4])) {
                    return $this->commentController->setCommentStatus($url[2], $url[3], $url[4]);
                }
                //ARTICLE
                else if ($url[1] == "article") {
                    if (!empty($url[2])) {
                        if ($url[2] == "new") {
                            return $this->postController->setPostPage();
                        } elseif ($url[2] == "add") {
                            return $this->postController->addNewPost();
                        } elseif ($url[2] == "edit" && !empty($url[3])) {
                            return $this->postController->setPostPage($url[3]);
                        } elseif ($url[2] == "editArticle" && !empty($url[3])) {
                            return $this->postController->editPost($url[3]);
                        } elseif ($url[2] == "delete" && !empty($url[3])) {
                            return $this->postController->deletePost($url[3]);
                        } elseif ($url[2] == "see-more" && !empty($url[3])) {
                            return $this->postController->seeMoreDashboardPosts($url[3]);
                        }
                        else{
                            return $this->requestController->get404Error();
                        }
                    } else {
                        return $this->postController->getDashboardPosts();
                    }
                }
                //USERS 
                else if ($url[1] == "user") {
                    if ($checkUser == "admin") {
                        if (!empty($url[2])) {
                            if($url[2] == "new"){
                                return $this->userController->setUserPage();
                            } elseif ($url[2] == "add") {
                                return $this->userController->addNewUser();
                            } elseif ($url[2] == "edit" && !empty($url[3])) {
                                return $this->userController->setUserPage($url[3]);
                            } elseif ($url[2] == "editUser" && !empty($url[3])) {
                                return $this->userController->editUser($url[3]);
                            } elseif ($url[2] == "delete" && !empty($url[3])) {
                                return $this->userController->deleteUser($url[3]);
                            } 
                        } else {
                            return $this->userController->getDashboardUsers();
                        }
                    } else {
                        return $this->userController->getUserTypeError();
                    }
                }
                //COMMENTAIRES
                else if ($url[1] == "comment") {
                    if (!empty($url[2])) {
                        if ($url[2] == "see-more" && !empty($url[3])) {
                            return $this->commentController->seeMoreDashboardComments($url[3]);
                        } elseif ($url[2] == "delete" && !empty($url[3])) {
                            return $this->commentController->deleteComment($url[3]);
                        } 
                    } else {
                        return $this->commentController->getAllComments();
                    }
                }
                //DECONNEXION
                else if ($url[1] == "disconnection") {
                    return $this->requestController->disconnectAdmin();
                }
                else {
                    return $this->requestController->getAdminDashboard();
                }
            } else {
                return $this->requestController->getAdminDashboard();
            }
        } else {
            return $this->requestController->getErrorAdminConnection();
        }
    }   
}
