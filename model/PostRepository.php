<?php
include_once("model/ClassPdo.php");
include_once("entity/Post.php");

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
     * @param int maxID max of post ID
     * @return array allPosts 
     */
    public function getPosts($limit = 0, $maxID = 0)
    {
        if ($maxID != 0) { 
            $req = "SELECT id FROM blog_post WHERE id < $maxID ORDER BY id DESC LIMIT $limit";
        } elseif ($limit != 0) {
            $req = "SELECT id FROM blog_post ORDER BY id DESC LIMIT $limit";
        } else {
            $req = "SELECT id FROM blog_post";
        }
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetchAll();

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
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetch();

        if(!isset($value['id'])){
            return null;
        }

        $post = new Post();
        $post->setID($value['id']);
        $post->setTitle($value['title']);
        $post->setExtract($value['extract']);
        $post->setContent($value['content']);
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
    public function getCatPosts($catID, $limit = 0, $maxID = 0)
    {
        $req = "SELECT p.id FROM blog_post p, category_blog_post c WHERE p.id = c.id_blog_post AND c.id_category = $catID";
        
        if ($maxID != 0) { 
            $req .= " AND p.id < $maxID ORDER BY p.id DESC LIMIT $limit";
        } elseif ($limit != 0) {
            $req .= " ORDER BY p.id DESC LIMIT $limit";
        }
        
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetchAll();

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
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetchAll();

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
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetchAll();

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
    public function getAllValidComments($post)
    {
        $postID = $post->getID();
        $req = "SELECT id FROM comment WHERE comment_status = 'isValid' AND id_blog_post = $postID ORDER BY id DESC";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetchAll();

        $allComments = [];
        foreach($value as $catID){
            array_push($allComments, $catID['id']);
        }

        return $allComments;
    }
    
    /**
     * @param int idAuthor
     * @return Post post Post which is created
     */
    public function newPost($idAuthor)
    {
        $req = "INSERT INTO blog_post(title, extract, content, img, add_at, last_edit_at, id_author) VALUES ('','','','',NOW(),NOW(), $idAuthor)";
        $rs = ClassPdo::$monPdo->query($req);

        $req = "SELECT id, add_at, last_edit_at, id_author FROM blog_post WHERE id = (SELECT MAX(id) FROM blog_post)";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetch();

        $post = new Post();
        $post->setID($value['id']);
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
        $title = $post->getTitle();
        $extract = $post->getExtract();
        $content = $post->getContent();
        $img = $post->getImg();
        $author = $post->getAuthor();

        $req = "UPDATE blog_post SET title = '$title', extract = '$extract', content = '$content', img = '$img', id_author = '$author', last_edit_at = NOW() WHERE id = $id ";
        ClassPdo::$monPdo->query($req);
    }

    /**
     * @param Post post
     */
    public function deletePost($post){
        $id = $post->getID();
        $req = "DELETE FROM blog_post WHERE id=$id";
        ClassPdo::$monPdo->query($req);
    }
}
?>
