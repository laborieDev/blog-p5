<?php
class Router
{
    public $postController;
    public $commentController;
    public $userController;
    public $requestController;

    public $adminRouter;
    public $ajaxRouter;

    public $url;

    public function __construct()
    {
        $this->postController = new PostController;
        $this->commentController = new CommentController;
        $this->userController = new UserController;
        $this->requestController = new RequestController;

        $this->adminRouter = new AdminRouter;
        $this->ajaxRouter = new AjaxRouter;

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
            $page = $this->postController->getHomePage();
        }

        //ARTICLE SINGLE
        elseif ($this->url[0] == 'article' && !empty($this->url[1])) {
            $page = $this->postController->getArticleContent($this->url[1]);
        }

        //AJAX REQUEST
        elseif ($this->url[0] == 'ajax' && !empty($this->url[1])) {
            $page = $this->ajaxRouter->getRoute($this->url);
        }

        //ADMIN CONNECTION - AJAX
        elseif ($this->url[0] == 'user-connect') {
            $page = $this->requestController->connectUser();
        }

        //ADMIN 
        elseif ($this->url[0] == 'admin') {
            $page = $this->adminRouter->getRoute($this->url);
        }

        //ERROR 404
        else {
            $page = $this->requestController->get404Error();
        }

        require_once("./templates/page.html");
    }   
}
