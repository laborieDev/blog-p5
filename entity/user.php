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

    private $userRepository;

    public function __construct($id){
        $this->userRepository = UserRepository::getclass_pdo();
        $this->id = $id;
        $this->lastName = $this->userRepository->getLastName($id);
        $this->firstName = $this->userRepository->getFirstName($id);
        $this->email = $this->userRepository->getEmail($id);
        $this->password = $this->userRepository->getPassword($id);
        $this->addAt = $this->userRepository->getAddAt($id);
        $this->userType = $this->userRepository->isAdmin($id);
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
        if($userType == "admin")
            return true;
        return false;
    }

    public function setIsAdmin($new){
        $this->userType = $new;
        $this->userRepository->setIsAdmin($new, $this->id);
    }
}