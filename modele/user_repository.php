<?php
include_once("modele/class_pdo.php");
class UserRepository extends class_pdo{

	public  static function getclass_pdo(){
		if(class_pdo::$monclass_pdo==null){
			class_pdo::$monclass_pdo= new UserRepository();
		}
		return class_pdo::$monclass_pdo;
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
        // $value = $rs->fetch();
        return $rs;
    }

    public function isAdmin($id){
        $req = "SELECT is_admin FROM user WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        // $value = $rs->fetch();
        if($rs == "admin")
            return true;
        return false;
    }

    public function setIsAdmin($new, $id){
        if($new == true)
            $req = "UPDATE user SET is_admin = 'admin' WHERE id = $id";
        else
            $req = "UPDATE user SET is_admin = 'author' WHERE id = $id";
        class_pdo::$monPdo->query($req);
    }


}
?>