<?php
include_once "model/ClassPdo.php";
include_once "entity/Comment.php";

class CommentRepository extends ClassPdo
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
     * @param int limit Limit of comments
     * @param int nbPage
     * @return array allComments
     */
    public function getComments($limit = 0, $nbPage = 1)
    {
        $req = "SELECT id FROM comment";
        if ($limit != 0) {
            $page = ($nbPage - 1) * $limit;
            $req = "SELECT id FROM comment ORDER BY id DESC LIMIT $page, $limit";
        } 

        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetchAll();

        $allComments = [];

        foreach($value as $comment){
            array_push($allComments, $this->getComment($comment['id']));
        }

        return $allComments;
    }

    /**
     * @return array allComments Comments which status is Waiting
     */
    public function getWaitingComments()
    {
        $req = "SELECT id FROM comment WHERE comment_status = 'waiting'";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetchAll();

        $allComments = [];

        foreach($value as $comment){
            array_push($allComments, $this->getComment($comment['id']));
        }

        return $allComments;
    }

    /**
     * @param int id Comment's ID
     * @return Comment comment
     */
    public function getComment($id)
    {
        $req = "SELECT * FROM comment WHERE id = $id";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();

        $comment = new Comment();
        $comment->setID($value['id']);
        $comment->setAuthorName($value['author_name']);
        $comment->setContent($value['content']);
        $comment->setCommentStatus($value['comment_status']);
        $comment->setAddAt($value['add_at']);
        $comment->setPost($value['id_blog_post']);

        return $comment;
    }

    /**
     * @return int number of comments
     */
    public function getNumberComment()
    {
        $req = "SELECT count(id) FROM comment WHERE comment_status = 'waiting' OR comment_status = 'isValid'";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();

        return $value[0];
    }

    /**
     * @return int min ID of all comments
     */
    public function getCommentMinID()
    {
        $req = "SELECT MIN(id) FROM comment";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();

        return $value[0];
    }
    
    /**
     * @param int postID 
     * @return Comment comment which is created
     */
    public function newComment($postID)
    {
        $req = "INSERT INTO comment(author_name, content, comment_status, add_at, id_blog_post) VALUES ('', '', 'waiting', NOW(), $postID)";
        $result = ClassPdo::$monPdo->query($req);

        $req = "SELECT id, add_at, comment_status, id_blog_post FROM comment WHERE id = (SELECT MAX(id) FROM comment)";
        $result = ClassPdo::$monPdo->query($req);
        $value = $result->fetch();

        $comment = new Comment();
        $comment->setID($value['id']);
        $comment->setAddAt($value['add_at']);
        $comment->setCommentStatus($value['comment_status']);
        $comment->setPost($value['id_blog_post']);

        return $comment;
    }

    /**
     * @param Comment comment
     */
    public function updateComment($comment)
    {
        $commentID = $comment->getID();
        $authorName = addslashes($comment->getAuthorName());
        $content = addslashes($comment->getContent());
        $commentStatus = $comment->getCommentStatus();

        $req = "UPDATE comment SET author_name = '$authorName', content = '$content', comment_status = '$commentStatus' WHERE id = $commentID ";
        ClassPdo::$monPdo->query($req);
    }

    /**
     * @param Comment comment
     */
    public function deleteComment($comment){
        $commentID = $comment->getID();
        $req = "DELETE FROM comment WHERE id=$commentID";
        ClassPdo::$monPdo->query($req);
    }
}
?>
