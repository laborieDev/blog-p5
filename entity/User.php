<?php
    
class User{
    private $id;
    private $lastName;
    private $firstName;
    private $email;
    private $password;
    private $addAt;
    private $userType;

    /**
     * @return int user's id
     */
    public function getID(){
        return $this->id;
    }

    /**
     * @param int new new user's ID
     */
    public function setID($new){
        $this->id = $new;
    }

    /**
     * @return string user's last name
     */
    public function getLastName(){
        return $this->lastName;
    }

    /**
     * @param string new New Last name
     */
    public function setLastName($new){
        $this->lastName = $new;
    }
    
    /**
     * @return string user's first name
     */
    public function getFirstName(){
        return $this->firstName;
    }

    /**
     * @param string new New First name
     */
    public function setFirstName($new){
        $this->firstName = $new;
    }

    /**
     * @return string user's email
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @param string new New Email
     */
    public function setEmail($new){
        $this->email = $new;
    }

    /**
     * @return string user's password
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * @param string new New password
     */
    public function setPassword($new){
        $this->password = $new;
    }

    /**
     * @return Date Date of this user has been created
     */
    public function getAddAt(){
        return $this->addAt;
    }

    /**
     * @param Date new Date of this user has been created
     */
    public function setAddAt($new){
       $this->addAt = $new;
    }

    /**
     * @return string user's type (admin|author)
     */
    public function getUserType(){
        return $this->userType;
    }

    /**
     * @param string new New user's type (admin|author)
     */
    public function setUserType($new){
        $this->userType = $new;
    }
}
