<?php
include_once "model/ClassPdo.php";
include_once "entity/Post.php";

class PostRepository extends ClassPdo
{
    /**
     * @return ClassPdo ClassPdo for database connection
     */
    public  static function getClassPdo()
    {
		if(ClassPdo::$monClassPdo==null){
			ClassPdo::$monClassPdo= new PostRepository();
        }
        
		return ClassPdo::$monClassPdo;
    }

    /**
     * @param int limit Limit of posts
     * @param int nbPage 
     * @return array allPosts 
     */
    public function getPosts($limit = 0, $nbPage = 1)
    {
        $req = "SELECT id FROM blog_post";

        if ($limit != 0) {
            $page = ($nbPage - 1) * $limit;
            $req = "SELECT id FROM blog_post ORDER BY id DESC LIMIT $page, $limit";
        } 

        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetchAll();

        $allPosts = [];

        foreach($value as $post){
            array_push($allPosts, $this->getPost($post['id']));
        }

        return $allPosts;
    }

    /**
     * @param int id post's ID
     * @return Post post
     */
    public function getPost($id)
    {
        $req = "SELECT * FROM blog_post WHERE id = $id";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();

        if (!isset($value['id'])) {
            return null;
        }

        $post = new Post();
        $post->setID($value['id']);
        $post->setTitle($value['title']);
        $post->setExtract($value['extract']);
        $post->setContent($value['content']);
        $post->setViews($value['views']);
        $post->setImg($value['img']);
        $post->setAddAt($value['add_at']);
        $post->setLastEditAt($value['last_edit_at']);
        $post->setAuthor($value['id_author']);

        return $post;
    }

    /**
     * @param int catID ID of category
     * @param int limit Limit of posts
     * @param int maxID max of post ID 
     * @return array posts Posts of this Category
     */
    public function getCatPosts($catID, $limit = 0, $nbPage = 1)
    {
        $req = "SELECT p.id FROM blog_post p, category_blog_post c WHERE p.id = c.id_blog_post AND c.id_category = $catID";
        
        if ($limit != 0) {
            $page = ($nbPage - 1) * $limit;
            $req .= " ORDER BY p.id DESC LIMIT $page, $limit";
        }
        
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetchAll();

        $posts = [];

        foreach($value as $post){
            array_push($posts, $this->getPost($post['id']));
        }

        return $posts;
    }

    /**
     * @param Post post
     * @return array allCats Categories of this post
     */
    public function getAllCategories($post)
    {
        $postID = $post->getID();
        $req = "SELECT id_category FROM category_blog_post WHERE id_blog_post = $postID";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetchAll();

        $allCats = [];
        foreach($value as $catID){
            array_push($allCats, $catID['id_category']);
        }

        return $allCats;
    }

    /**
     * @param Post post
     * @return array allComments Comments of this Post
     */
    public function getAllComments($post)
    {
        $postID = $post->getID();
        $req = "SELECT id FROM comment WHERE id_blog_post = $postID";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetchAll();

        $allComments = [];
        foreach($value as $catID){
            array_push($allComments, $catID['id']);
        }

        return $allComments;
    }

    /**
     * @param Post post
     * @return array allComments Valid Comments of this Post
     */
    public function getAllValidComments($post, $limit = 0, $maxID = 0)
    {
        $postID = $post->getID();
        $req = "SELECT id FROM comment WHERE comment_status = 'isValid' AND id_blog_post = $postID";

        if ($maxID != 0) { 
            $req .= " AND id < $maxID ORDER BY id DESC LIMIT $limit";
        } elseif ($limit != 0) {
            $req .= " ORDER BY id DESC LIMIT $limit";
        }

        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetchAll();

        $allComments = [];
        foreach($value as $catID){
            array_push($allComments, $catID['id']);
        }

        return $allComments;
    }

    /**
     * @return int number of all views
     */
    public function getAllViews()
    {
        $req = "SELECT SUM(views) FROM blog_post";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();

        return $value[0];
    }

    /**
     * @param int catID 
     * @return int min ID of all posts
     */
    public function getPostMinID($catID = 0)
    {
        if ($catID != 0) {
            $req = "SELECT MIN(p.id) FROM blog_post p, category_blog_post c WHERE p.id = c.id_blog_post AND c.id_category = $catID";
        } else {
            $req = "SELECT MIN(id) FROM blog_post";
        }
        
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();

        return $value[0];
    }

    /**
     * Add Post's category
     * @param Post post 
     * @param int catID 
     */
    public function addPostCategory($post, $catID)
    {
        $postID = $post->getID();
        $req = "INSERT INTO category_blog_post VALUES ($catID, $postID)";
        ClassPdo::$monPdo->query($req);
    }
    
    /**
     * @param int idAuthor
     * @return Post post Post which is created
     */
    public function newPost($idAuthor)
    {
        $req = "INSERT INTO blog_post(title, extract, content, img, views, add_at, last_edit_at, id_author) VALUES ('','','','', 0, NOW(),NOW(), $idAuthor)";
        $result = ClassPdo::$monPdo->query($req);

        $req = "SELECT id, views, add_at, last_edit_at, id_author FROM blog_post WHERE id = (SELECT MAX(id) FROM blog_post)";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();

        $post = new Post();
        $post->setID($value['id']);
        $post->setViews($value['views']);
        $post->setAddAt($value['add_at']);
        $post->setLastEditAt($value['last_edit_at']);
        $post->setAuthor($value['id_author']);

        return $post;
    }
    
    /**
     * @param Post post
     */
    public function updatePost($post)
    {
        $id = $post->getID();
        $title = addslashes($post->getTitle());
        $extract = addslashes($post->getExtract());
        $content = addslashes($post->getContent());
        $img = $post->getImg();
        $views = $post->getViews();
        $author = $post->getAuthor();

        $req = "UPDATE blog_post SET title = '$title', extract = '$extract', content = '$content', img = '$img', views = '$views', id_author = '$author', last_edit_at = NOW() WHERE id = $id ";
        ClassPdo::$monPdo->query($req);
    }

    /**
     * @param Post post
     */
    public function deleteCatsPostRelation($post){
        $id = $post->getID();
        $req = "DELETE FROM category_blog_post WHERE id_blog_post=$id";
        ClassPdo::$monPdo->query($req);
    }

    /**
     * @param Post post
     */
    public function deleteAllPostComments($post){
        $id = $post->getID();
        $req = "DELETE FROM comment WHERE id_blog_post=$id";
        ClassPdo::$monPdo->query($req);
    }

    /**
     * @param Post post
     */
    public function deletePost($post){
        $this->deleteCatsPostRelation($post);
        $this->deleteAllPostComments($post);
        $id = $post->getID();
        $req = "DELETE FROM blog_post WHERE id=$id";
        ClassPdo::$monPdo->query($req);
    }
}
?>
