<?php
require_once("modele/user_repository.php");
    
class User{
    private $id;
    private $lastName;
    private $firstName;
    private $email;
    private $password;
    private $addAt;
    private $userType;
    private $postsID;

    private $userRepository;

    public function __construct($id=-1){
        $this->userRepository = UserRepository::getclass_pdo();
        if($id == -1){
            $id = $this->userRepository->newUser();
        }
        $this->id = $id;
        $this->lastName = $this->userRepository->getLastName($id);
        $this->firstName = $this->userRepository->getFirstName($id);
        $this->email = $this->userRepository->getEmail($id);
        $this->password = $this->userRepository->getPassword($id);
        $this->addAt = $this->userRepository->getAddAt($id);
        $this->userType = $this->userRepository->isAdmin($id);
        $this->postsID = $this->userRepository->getAllPosts($id);
    }

    public function getId(){
        return $this->id;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setLastName($new){
        $this->lastName = $new;
        $this->userRepository->setLastName($new, $this->id);
    }
    
    public function getFirstName(){
        return $this->firstName;
    }

    public function setFirstName($new){
        $this->firstName = $new;
        $this->userRepository->setFirstName($new, $this->id);
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($new){
        $this->email = $new;
        $this->userRepository->setEmail($new, $this->id);
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($new){
        $this->password = $new;
        $this->userRepository->setPassword($new, $this->id);
    }

    public function getAddAt(){
        return $this->addAt;
    }

    public function isAdmin(){
        return $this->userType;
    }

    public function setIsAdmin($new){
        $this->userType = $new;
        $this->userRepository->setIsAdmin($new, $this->id);
    }

    public function getPostsID(){
        return $this->postsID;
    }

    public function deleteUser(){
        $this->userRepository->deleteUser($this->id);
    }
}