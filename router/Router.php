<?php
class Router
{
    public function getRoute()
    {  
        $postController = new PostController;
        $requestController = new RequestController;
        $url = '';

        if (isset($_GET['url'])) {
            $url = explode('/', $_GET['url']);
        }

        if ($url == '') {
            echo $postController->getHomePage();
        }

        elseif ($url[0] == 'ajax' && !empty($url[1])) {
            /**** BLOG POSTS HOME PAGE ****/
            if ($url[1] == 'more-post' && !empty($url[2])) {
                echo $requestController->seeMorePost($url[2]);
            }
            elseif ($url[1] == 'see-all-post') {
                echo $requestController->seeMorePost();
            }
            elseif ($url[1] == 'see-cat-post' && !empty($url[2])) {
                if (!empty($url[3])) {
                    echo $requestController->seeCatPost($url[2], $url[3]);
                }
                else {
                    echo $requestController->seeCatPost($url[2]);
                }
            }
        }

        else {
            echo $requestController->get404Error();
        }
    }
}