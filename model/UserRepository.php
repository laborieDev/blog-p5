<?php
include_once "model/ClassPdo.php";
include_once "entity/User.php";

class UserRepository extends ClassPdo
{
    /**
     * @return ClassPdo ClassPdo for database connection
     */
    public  static function getClassPdo()
    {
		if(ClassPdo::$monClassPdo==null){
			ClassPdo::$monClassPdo= new UserRepository();
        }
        
		return ClassPdo::$monClassPdo;
    }

    /**
     * @return array allUsers
     */
    public function getUsers()
    {
        $req = "SELECT id FROM user";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetchAll();

        $allUsers = [];

        foreach($value as $user){
            array_push($allUsers, $this->getUser($user['id']));
        }

        return $allUsers;
    }

    /**
     * @param int userID User's ID
     * @return User user
     */
    public function getUser($userID)
    {
        $req = "SELECT * FROM user WHERE id = $userID";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();

        if (isset($value['id'])) {
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

        return false;
    }

    /**
     * Get User which dataName's value = dataValue
     * @param string dataName 
     * @param string dataValue
     * @return User user
     */
    public function getUserParameter($dataName, $dataValue)
    {
        $req = "SELECT id FROM user WHERE $dataName = '$dataValue'";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetchAll();

        if (!isset($value[0]['id'])) {
            return ;
        }

        $user = $this->getUser($value[0]['id']);

        return $user;
    }

    /**
     * @param User user
     * @return array allPosts User's posts
     */
    public function getAllPosts($user)
    {
        $userID = $user->getID();
        $req = "SELECT id FROM blog_post WHERE id_author = $userID";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetchAll();

        $allPosts = [];
        foreach($value as $postID){
            array_push($allPosts, $postID['id']);
        }

        return $allPosts;
    }

    /**
     * @param string email
     * @return boolean true if this email exists for another user
     */
    public function emailExists($email)
    {
        $req = "SELECT COUNT(id) FROM user WHERE email='$email'";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();
        
        if ($value[0] >= 1) {
            return true;
        }

        return false;
    }

    /**
     * @return User user which is created
     */
    public function newUser()
    {
        $req = "INSERT INTO user(last_name, first_name, email, password, add_at, user_type) VALUES ('','','','',NOW(),'author')";
        $result = ClassPdo::$monPdo->query($req);

        $req = "SELECT id, add_at FROM user WHERE id = (SELECT MAX(id) FROM user)";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();

        $user = new User();
        $user->setID($value['id']);
        $user->setAddAt($value['add_at']);

        return $user;
    }

    /**
     * @param User user 
     */
    public function updateUser($user)
    {
        $userID = $user->getID();
        $lastName = addslashes($user->getLastName());
        $firstName = addslashes($user->getFirstName());
        $email = $user->getEmail();
        $password = addslashes($user->getPassword());
        $userType = $user->getUserType();

        $req = "UPDATE user SET last_name = '$lastName', first_name = '$firstName', email = '$email', password = '$password', user_type = '$userType' WHERE id = $userID ";
        ClassPdo::$monPdo->query($req);
    }

    /**
     * @param User user 
     */
    public function deleteUser($user)
    {
        $userID = $user->getID();
        $req = "DELETE FROM user WHERE id=$userID";
        ClassPdo::$monPdo->query($req);
    }
}
?>
