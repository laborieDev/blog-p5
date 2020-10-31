<?php
require_once("modele/post_repository.php");
require_once("entity/user.php");
    
class Post{
    private $id;
    private $title;
    private $extract;
    private $content;
    private $addAt;
    private $lastEditAt;
    private $author;
    private $categories = [];

    private $postRepository;

    public function __construct($id){
        $this->postRepository = PostRepository::getclass_pdo();
        $this->id = $id;
        $this->title = $this->postRepository->getTitle($id);
        $this->extract = $this->postRepository->getExtract($id);
        $this->content = $this->postRepository->getContent($id);
        $this->addAt = $this->postRepository->getAddAt($id);
        $this->lastEditAt = $this->postRepository->getLastEditAt($id);
        $this->author = new User($this->postRepository->getAuthor($id)); // A VOIR SI CA MARCHE

        // A VOIR AVEC L'ENTITE CATEGORY
        // $categoriesId = $this->postRepository->getAllCategory($id);
        // for($i=0; $i<sizeof($categoriesId); $i++)
        //     $this->categories[$i] = new Category($categoriesId[$i]);
    }


    public function getTitle(){
        return $this->title;
    }

    public function setTitle($new){
        $this->title = $new;
        $this->postRepository->setTitle($new, $this->id);
    }
    
    public function getExtract(){
        return $this->extract;
    }

    public function setExtract($new){
        $this->extract = $new;
        $this->postRepository->setExtract($new, $this->id);
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($new){
        $this->content = $new;
        $this->postRepository->setContent($new, $this->id);
    }

        /// A MODIFIER A PARTIR D'ICI
        
    public function getPassword(){
        return $this->password;
    }

    public function setPassword($new){
        $this->password = $new;
        $this->postRepository->setPassword($new, $this->id);
    }

    public function getAddAt(){
        return $this->addAt;
    }

    public function isAdmin(){
        if($userType == "admin")
            return true;
        return false;
    }

    public function setIsAdmin($new){
        $this->userType = $new;
        $this->postRepository->setIsAdmin($new, $this->id);
    }
}