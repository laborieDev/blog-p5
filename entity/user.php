<?php
    class User{
        private $id;
        private $lastName;
        private $firstName;
        private $email;
        private $password;
        private $addAt;
        private $userType;

        protected function __construct($id){
            $req = "SELECT * FROM user WHERE id = $id";
            $rs = $pdo->query($req);
            $ligne = $rs->fetch();
            
            $this->id = $id;
            $this->lastName = $ligne['last_name'];
            $this->firstName = $ligne['first_name'];
            $this->email = $ligne['email'];
            $this->password = $ligne['password'];
            $this->addAt = $ligne['add_at'];
            $this->userType = $ligne['userType'];
        }

        public function getLastName(){
            return $lastName;
        }

        public function setLastName($new){
            $req = "UPDATE user SET last_name = $new WHERE id = $id";
            $pdo->query($req);
        }
        
        public function getFirstName(){
            return $firstName;
        }

        public function setFirstName($new){
            $req = "UPDATE user SET first_name = $new WHERE id = $id";
            $pdo->query($req);
        }

        public function getEmail(){
            return $email;
        }

        public function setEmail($new){
            $req = "UPDATE user SET email = $new WHERE id = $id";
            $pdo->query($req);
        }

        public function getPassword(){
            return $password;
        }

        public function setPassword($new){
            $req = "UPDATE user SET password = '$new' WHERE id = $id";
            $pdo->query($req);
        }

        public function getAddAt(){
            return $addAt;
        }

        public function isAdmin(){
            if($userType == "admin")
                return true;
            return false;
        }

        public function setIsAdmin($new){
            if($new == true)
                $req = "UPDATE user SET is_admin = 'admin' WHERE id = $id";
            else
                $req = "UPDATE user SET is_admin = 'author' WHERE id = $id";
            $pdo->query($req);
        }
    }