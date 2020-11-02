<?php
include_once("modele/mdl_data_base.php");

class UserRepository extends mdl_data_base{

	public  static function getclass_pdo(){
		if(class_pdo::$monclass_pdo==null){
			class_pdo::$monclass_pdo= new UserRepository();
		}
		return class_pdo::$monclass_pdo;
    }

    public function newUser(){
        $req = "INSERT INTO user(last_name, first_name, email, password, add_at, user_type) VALUES ('','','','',NOW(),'author')";
        $rs = class_pdo::$monPdo->query($req);
        $req = "SELECT MAX(id) FROM user";
        $rs = class_pdo::$monPdo->query($req);
        $value = $rs->fetch();
        return $value[0];
    }

    public function getLastName($id){
        $req = "SELECT last_name FROM user WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $value = $rs->fetch();
        return $value[0];
    }

    public function setLastName($new, $id){
        $req = "UPDATE user SET last_name = '$new' WHERE id = $id";
        class_pdo::$monPdo->query($req);
    }
    
    public function getFirstName($id){
        $req = "SELECT first_name FROM user WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $value = $rs->fetch();
        return $value[0];
    }

    public function setFirstName($new, $id){
        $req = "UPDATE user SET first_name = '$new' WHERE id = $id";
        class_pdo::$monPdo->query($req);
    }

    public function getEmail($id){
        $req = "SELECT email FROM user WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $value = $rs->fetch();
        return $value[0];
    }

    public function setEmail($new, $id){
        $req = "UPDATE user SET email = '$new' WHERE id = $id";
        class_pdo::$monPdo->query($req);
    }

    public function getPassword($id){
        $req = "SELECT password FROM user WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $value = $rs->fetch();
        return $value[0];
    }

    public function setPassword($new, $id){
        $req = "UPDATE user SET password = '$new' WHERE id = $id";
        class_pdo::$monPdo->query($req);
    }

    public function getAddAt($id){
        $req = "SELECT add_at FROM user WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $value = $rs->fetch();
        $value = mdl_data_base::dateUsToFr($value[0]);
        return $value;
    }

    public function isAdmin($id){
        $req = "SELECT is_admin FROM user WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        if($rs == "admin")
            return true;
        return false;
    }

    public function setIsAdmin($new, $id){
        if($new == true)
            $req = "UPDATE user SET user_type = 'admin' WHERE id = $id";
        else
            $req = "UPDATE user SET user_type = 'author' WHERE id = $id";
        class_pdo::$monPdo->query($req);
    }

    public function getAllPosts($id){
        $req = "SELECT id FROM blog_post WHERE id_author = $id";
        $rs = class_pdo::$monPdo->query($req);
        $values = $rs->fetchAll();
        return $values;
    }

    public function deleteUser($id){
        $req = "DELETE FROM user WHERE id=$id";
        class_pdo::$monPdo->query($req);
    }

}
?>