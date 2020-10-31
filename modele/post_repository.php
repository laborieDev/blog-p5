<?php
include_once("modele/class_pdo.php");
class PostRepository extends class_pdo{

	public  static function getclass_pdo(){
		if(class_pdo::$monclass_pdo==null){
			class_pdo::$monclass_pdo= new UserRepository();
		}
		return class_pdo::$monclass_pdo;
    }

    public function getTitle($id){
        $req = "SELECT title FROM blog_post WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $value = $rs->fetch();
        return $value[0];
    }

    public function setTitle($new, $id){
        $req = "UPDATE blog_post SET title = '$new' WHERE id = $id";
        class_pdo::$monPdo->query($req);
    }
    
    public function getExtract($id){
        $req = "SELECT extract FROM blog_post WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $value = $rs->fetch();
        return $value[0];
    }

    public function setExtract($new, $id){
        $req = "UPDATE blog_post SET extract = '$new' WHERE id = $id";
        class_pdo::$monPdo->query($req);
    }

    public function getContent($id){
        $req = "SELECT content FROM blog_post WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $value = $rs->fetch();
        return $value[0];
    }

    public function setContent($new, $id){
        $req = "UPDATE blog_post SET content = '$new' WHERE id = $id";
        class_pdo::$monPdo->query($req);
    }

    public function getAddAt($id){
        $req = "SELECT add_at FROM blog_post WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        return $rs;
    }

    public function getLastEditAt($id){
        $req = "SELECT last_edit_at FROM blog_post WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        return $rs;
    }

    public function setLastEditAt($id){
        $req = "UPDATE blog_post SET last_edit_at = NOW() WHERE id = $id";
        class_pdo::$monPdo->query($req);
    }

    public function getAuthorId($id){
        $req = "SELECT id_author FROM blog_post WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        return $rs;
    }

    public function getAllCategory($id){
        $req = "SELECT id_category FROM category_blog_post WHERE id_blog_post = $id";
        $rs = class_pdo::$monPdo->query($req);
        $array = $rs->fetchAll();
        return $array;
    }

    public function removeCategory($idCat, $id){
        $req = "DELETE FROM category_blog_post WHERE id_category = $idCat AND id_blog_post = $id";
        class_pdo::$monPdo->query($req);
    }

    public function addCategory($idCat, $id){
        $req = "INSERT INTO category_blog_post VALUES ($idCat, $id)";
        class_pdo::$monPdo->query($req);
    }

}
?>