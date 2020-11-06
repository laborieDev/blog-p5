<?php
    
class User{
    private $id;
    private $lastName;
    private $firstName;
    private $email;
    private $password;
    private $addAt;
    private $userType;

    public function getID(){
        return $this->id;
    }

    public function setID($new){
        $this->id = $new;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setLastName($new){
        $this->lastName = $new;
    }
    
    public function getFirstName(){
        return $this->firstName;
    }

    public function setFirstName($new){
        $this->firstName = $new;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($new){
        $this->email = $new;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($new){
        $this->password = $new;
    }

    public function getAddAt(){
        return $this->addAt;
    }

    public function setAddAt($new){
       $this->addAt = $new;
    }

    public function getUserType(){
        return $this->userType;
    }

    public function setUserType($new){
        $this->userType = $new;
    }

}