<?php
include_once("model/ClassPdo.php");
include_once("entity/Category.php");

class CategoryRepository extends ClassPdo
{

    public  static function getClassPdo()
    {
		if(ClassPdo::$monClassPdo==null){
			ClassPdo::$monClassPdo= new PostRepository();
        }
        
		return ClassPdo::$monClassPdo;
    }

    public function getCategories()
    {
        $req = "SELECT id FROM category";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetchAll();

        $allCat = [];

        foreach($value as $post){
            array_push($allCat, $this->getCategory($post['id']));
        }

        return $allCat;
    }

    public function getCategory($id)
    {
        $req = "SELECT * FROM category WHERE id = $id";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetch();

        $cat = new Category();
        $cat->setID($value['id']);
        $cat->setName($value['name']);

        return $cat;
    }
    
    public function newCategory()
    {
        $req = "INSERT INTO category(name) VALUES ('')";
        $rs = ClassPdo::$monPdo->query($req);

        $req = "SELECT MAX(id) FROM category";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetch();

        $cat = new Category();
        $cat->setID($value[0]);

        return $cat;
    }

    public function getAllPosts($cat)
    {
        $catID = $cat->getID();
        $req = "SELECT id_blog_post FROM category_blog_post WHERE id_category = $catID";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetchAll();

        $allPosts = [];
        foreach($value as $postID){
            array_push($allPosts, $postID['id_blog_post']);
        }

        return $allPosts;
    }

    public function updateCategory($cat)
    {
        $id = $cat->getID();
        $name = $cat->getName();

        $req = "UPDATE category SET name = '$name' WHERE id = $id ";
        ClassPdo::$monPdo->query($req);
    }

    public function deleteCategory($cat){
        $id = $cat->getID();
        $req = "DELETE FROM category WHERE id=$id";
        ClassPdo::$monPdo->query($req);
    }
}
?>