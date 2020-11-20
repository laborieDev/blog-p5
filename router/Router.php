<?php
class Router
{
    /**
     * Get Route and Display good page 
     */
    public function getRoute()
    {  
        $postController = new PostController;
        $commentController = new CommentController;
        $requestController = new RequestController;
        $url = '';

        if (isset($_GET['url'])) {
            $url = explode('/', $_GET['url']);
        }

        if ($url == '') {
            echo $postController->getHomePage();
        }

        //ARTICLE SINGLE
        elseif ($url[0] == 'article' && !empty($url[1])) {
            echo $postController->getArticleContent($url[1]);
        }

        //AJAX REQUEST
        elseif ($url[0] == 'ajax' && !empty($url[1])) {
            /**** BLOG POSTS HOME PAGE ****/
            if ($url[1] == 'more-post' && !empty($url[2])) {
                echo $requestController->seeMorePost($url[2]);
            } elseif ($url[1] == 'see-all-post') {
                echo $requestController->seeMorePost();
            } elseif ($url[1] == 'see-cat-post' && !empty($url[2])) {
                if (!empty($url[3])) {
                    echo $requestController->seeCatPost($url[2], $url[3]);
                } else {
                    echo $requestController->seeCatPost($url[2]);
                }
            }
            /**** NEW COMMENT SINGLE POST ****/
            elseif ($url[1] == 'new-comment' && !empty($url[2]) && !empty($url[3]) && !empty($url[4])) {
                echo $requestController->saveNewComment($url[2], $url[3], $url[4]);
            }
        }

        //ADMIN CONNECTION - AJAX
        elseif ($url[0] == 'user-connect'){
            echo $requestController->connectUser();
        }

        //ADMIN 
        elseif ($url[0] == 'admin') {
            $checkUser = $requestController->checkUser();
            if ($checkUser != "false") {
                if (isset($url[1])) {
                    //CHANGEMENT STATUS COMMENTAIRE
                    if ($url[1] == "set-comment" && !empty($url[2]) && !empty($url[3])) {
                        echo $commentController->setCommentStatus($url[2], $url[3]);
                    }
                    //DECONNEXION
                    else if ($url[1] == "disconnection") {
                        echo $requestController->disconnectAdmin();
                    }
                    else {
                        echo $requestController->getAdminDashboard();
                    }
                } else {
                    echo $requestController->getAdminDashboard();
                }
            } else {
                echo $requestController->getErrorAdminConnection();
            }
        }

        //ERROR 404
        else {
            echo $requestController->get404Error();
        }
    }
}
