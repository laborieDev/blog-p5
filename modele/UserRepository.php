<?php
include_once("modele/ClassPdo.php");
include_once("entity/User.php");

class UserRepository extends ClassPdo
{

    public  static function getClassPdo()
    {
		if(ClassPdo::$monClassPdo==null){
			ClassPdo::$monClassPdo= new UserRepository();
        }
        
		return ClassPdo::$monClassPdo;
    }

    public function getUsers()
    {
        $req = "SELECT id FROM user";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetchAll();

        $allUsers = [];

        foreach($value as $user){
            array_push($allUsers, $this->getUser($user['id']));
        }

        return $allUsers;
    }

    public function getUser($id)
    {
        $req = "SELECT * FROM user WHERE id = $id";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetch();

        $user = new User();
        $user->setID($value['id']);
        $user->setLastName($value['last_name']);
        $user->setFirstName($value['first_name']);
        $user->setEmail($value['email']);
        $user->setPassword($value['password']);
        $user->setAddAt($value['add_at']);
        $user->setUserType($value['user_type']);

        return $user;
    }

    public function getAllPosts($user)
    {
        $userID = $user->getID();
        $req = "SELECT id FROM blog_post WHERE id_author = $userID";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetchAll();

        $allPosts = [];
        foreach($value as $postID){
            array_push($allPosts, $postID['id']);
        }

        return $allPosts;
    }

    public function newUser()
    {
        $req = "INSERT INTO user(last_name, first_name, email, password, add_at, user_type) VALUES ('','','','',NOW(),'author')";
        $rs = ClassPdo::$monPdo->query($req);

        $req = "SELECT id, add_at FROM user WHERE id = (SELECT MAX(id) FROM user)";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetch();

        $user = new User();
        $user->setID($value['id']);
        $user->setAddAt($value['add_at']);

        return $user;
    }

    public function updateUser($user)
    {
        $id = $user->getID();
        $lastName = $user->getLastName();
        $firstName = $user->getFirstName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $userType = $user->getUserType();

        $req = "UPDATE user SET last_name = '$lastName', first_name = '$firstName', email = '$email', password = '$password', user_type = '$userType' WHERE id = $id ";
        ClassPdo::$monPdo->query($req);
    }

    public function deleteUser($user)
    {
        $id = $user->getID();
        $req = "DELETE FROM user WHERE id=$id";
        ClassPdo::$monPdo->query($req);
    }



}
?>